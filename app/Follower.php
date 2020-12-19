<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
    public $timestamps = false;
    public $incrementing = false;

    //@return array(followed_id)フォローしているテーブルの取得(承認したユーザーのみ)
    public function followingIds()
    {
        $authuser = Auth::user();
        $user_id = $authuser->id;
        return $this->where('following_id', $user_id)->where('accepted',1)->get();
    }
}
