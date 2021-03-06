<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use App\Follower;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_image','birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Plan/Userの関係性
    public function plans(){
    return $this->hasMany('App\Plan');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    // 全てのユーザー取得
    public function getAllUsers(Int $user_id)
    {
        return $this->where('id', '<>', $user_id)->paginate(10);
    }

    // フォローする
    //@param $user_id
    //@return $user_idを追加
    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    //@param $user_id
    //@return $user_idを削除
    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }
    // フォローしているか
    //@param $user
    //@return $userのidがfollowed_idに存在するか
    public function isFollowing($user)
    {
        return $this->follows()->where('followed_id', $user->id)->exists();
    }
    // フォローされているか
    //@param $user
    //@return following_id に存在するかどうか
    public function isFollowed($user)
    {
        return $this->followers()->where('following_id', $user->id)->exists();
    }

    //@param $user(ユーザー情報)
    //@return $ifAccepted[0]->accepted == 1
    //承認されているかを確認 isAccepted=true(承認されている) isAccepted=false(承認されていない)
    public function isAccepted($user){
        $ifAccepted = $this->follows()->where('following_id',$this->id)->where("followed_id", $user->id)->select('accepted')->get();
        return $ifAccepted[0]->accepted == 1;
      }
}
