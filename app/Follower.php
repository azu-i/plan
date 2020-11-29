<?php

namespace App;

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
}
