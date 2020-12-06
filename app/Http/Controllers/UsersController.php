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
        $auth_user = auth()->user();
        if(!$auth_user->isFollowing($followed_user)){
            $auth_user->follow($followed_user->id);
            return back();
        }
    }

    //フォロー解除
    public function unfollow(Request $request)
    {
        $followed_user = User::find($request->user_id);
        $auth_user = auth()->user();
        if($auth_user->isFollowing($followed_user)){
            $auth_user->unfollow($followed_user->id);
            return back();
        }
    }

    public function edit()
    {
        $login_user = Auth::user();
        return view('users.edit', ['login_user' => $login_user]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'          => ['required', 'string', 'max:255'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);
        $validator->validate();
        $user->updateProfile($data);

        return redirect('users/'.$user->id);
    }

        public function show()
    {
        $login_user = Auth::user();
        return view('users.show',[
            'login_user' => $login_user,
        ]);
    }
}
