<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;
use App\User;
use Illuminate\Support\Facades\Auth;

class FollowerAcceptController extends Controller
{
    //@param Request
    //@return $result(follower_tableへのacceptedカラム保存)
    public function accept(Request $request) {
        $followAccept= Follower::where([["following_id",$request->user_id], ["followed_id", Auth::id()]])->first();
        // dd($followAccept);
        $followAccept->accepted = 1;
        $result = $followAccept->save();
        return redirect('/users');
    }

    public function unaccept(Request $request)
    {
        $followed_user = User::find($request->user_id);
        $auth_user = Auth::user();
        if($auth_user->isFollowed($followed_user)){
            $followed_user -> unfollow($auth_user->id);
        }
        return back();
    }
}
