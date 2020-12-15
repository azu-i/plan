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

    //フォロー機能
    public function follow(Request $request)
    {
        $followed_user = User::find($request->user_id);
        $auth_user = Auth::user();
        if(!$auth_user->isFollowing($followed_user)){
            $auth_user->follow($followed_user->id);
            return back();
        }
    }

    //フォロー解除
    public function unfollow(Request $request)
    {
        $followed_user = User::find($request->user_id);
        $auth_user = Auth::user();
        if($auth_user->isFollowing($followed_user)){
            $auth_user->unfollow($followed_user->id);
            return back();
        }
    }

    public function edit(User $user)
    {
        $login_user = Auth::user();
        return view('users.edit', ['login_user' => $login_user, 'user' => $user]);
    }

    // ユーザー情報の編集
    // @param Request
    public function update(Request $request)
    {
        $editUser = User::find(Auth::id());
        $plusInfo = $request -> all();
        if ($request->remove == 'true') {
            $plusInfo['profile_image'] = null;
        } elseif ($request->file('profile_image')) {
            $path = $request->file('profile_image')->store('public/image');
            $plusInfo['profile_image'] = basename($path);
        } else {
            $plusInfo['profile_image'] = $editUser->profile_image;
        }

        unset($plusInfo['remove']);
        unset($plusInfo['_token']);
        $editUser -> fill($plusInfo) -> save();

        return redirect('users/{user_id}/detail');
    }

    public function show()
    {
        $login_user = Auth::user();
        return view('users.show',[
            'login_user' => $login_user,
        ]);
    }


}

