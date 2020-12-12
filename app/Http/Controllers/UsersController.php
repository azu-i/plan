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

    public function edit(User $user)
    {
        $login_user = Auth::user();
        return view('users.edit', ['login_user' => $login_user, 'user' => $user]);
    }

    // ユーザー情報の編集
    // @param Request
    public function update(Request $request)
    {
        // $data = $request->all();
        // $validator = Validator::make($data, [
        //     'profile_image' => 'file||image||mimes:jpeg,png,jpg||max:2048',
        //     'birthday'         => 'string||date'
        // ]);
        // $validator->validate();
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

    public function userViewList(Follower $follower){
        $auth = Auth::user();
        $authuser_id = $auth->id;
        $lists = new User();

        // followed_idだけ抜き出す
        $follow_ids = $follower->followingIds($authuser_id);
        //ログイン中のfollowing_idに紐づくfollowed_idをarrayで取り出す
        $followed_ids = $follow_ids->pluck('followed_id')->toArray();
        array_push($followed_ids ,$authuser_id);
        //カレンダーの期間内のイベントを取得
        if($followed_ids !== null){
            $lists= User::whereIn('id', $followed_ids)->select('id','name')->get();
        }else{
            $lists = User::where('id', $authuser_id)->select('id','name')->get();
        }

        if($lists["id"] == $authuser_id){
            $color= "00008b";
        }else{
            $result = array_search($lists["id"], $followed_ids);
            // #008000=緑 #6a5acd=紫 #b22222=赤茶 #696969=グレイ #ff69b4=ピンク
            $event_color = ['#008000','#6a5acd','#b22222','#696969','#ff69b4'];
            $color = $event_color[$result];
        }
        return view('calendar', ['lists' => $lists, 'color' => $color]);

    }


}
