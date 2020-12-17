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
    //@return $all_users(全ユーザー取得)
    public function userlist()
    {
        $user = new User;
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('follow.userList',['all_users' => $all_users]);
    }

    //フォロー機能
    //@param Request
    //@return follow(詳細はUser.phpのfollowに記載あり)
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
    //@param Request
    //@return follow解除 （User.phpに詳細記載あり）
    public function unfollow(Request $request)
    {
        $followed_user = User::find($request->user_id);
        $auth_user = Auth::user();
        if($auth_user->isFollowing($followed_user)){
            $auth_user->unfollow($followed_user->id);
            return back();
        }
    }

    //@param
    //
    public function unaccept(Request $request)
    {
        $accepted_user = User::find($request->user_id);
        $auth_user = Auth::user();
        if($auth_user->isFollowed($accepted_user)){
            $auth_user->unfollow($accepted_user->id);
            return back();
        }
    }

    //user詳細編集
    //@param $users
    //@return view(編集後のユーザー情報表示)
    public function edit(User $user)
    {
        $login_user = Auth::user();
        return view('users.edit', ['login_user' => $login_user, 'user' => $user]);
    }

    // ユーザー情報の編集（DBへの保存）
    // @param Request
    //@return view(編集後のユーザー情報表示)
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

    //user詳細のview
    public function show()
    {
        $login_user = Auth::user();
        return view('users.show',[
            'login_user' => $login_user,
        ]);
    }


}

