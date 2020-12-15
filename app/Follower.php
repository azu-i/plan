<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //一つのデータに特定
    protected $primaryKey = [
        'following_id',
        'followed_id'
    ];
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
    public $timestamps = false;
    public $incrementing = false;

    // フォローしているテーブルの取得
    public function followingIds()
    {
        $authuser = Auth::user();
        $user_id = $authuser->id;
        return $this->where('following_id', $user_id)->get();
    }
}
