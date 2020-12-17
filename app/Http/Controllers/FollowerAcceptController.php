<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;
use Illuminate\Support\Facades\Auth;

class FollowerAcceptController extends Controller
{
    //@param Request
    //@return $result(follower_tableへのacceptedカラム保存)
    public function accept(Request $request) {
        $followAccept= Follower::where([["following_id",$request->user_id], ["followed_id", Auth::id()]])->first();
        // dd($request->user_id,$followAccept,Auth::id());
        $followAccept->accepted = 1;
        $result = $followAccept->update();
        return ['result' => $result];
    }
}
