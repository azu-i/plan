<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Follower;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function userlist()
    {
        $user = new User;
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('follow.userList',['all_users' => $all_users]);
    }

    //フォロー
    public function follow(){
        $user = new User;
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
            $follower->follow($user->id);
            return back();
        }

    }

    //フォロー解除
    public function unfollow(User $user){
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            $follower->unfollow($user->id);
            return redirect('/plan');
        }

    }
}
