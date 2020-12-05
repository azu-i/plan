<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = array('id');
    //
    public static $rules = array(
        'event_name' => 'required|max:20',
        'date' => 'required',
        'detail' => "max:30",
    );

    // Planに大してUserは１つ
    public function user(){
        return $this->belongsTo('App\User');
    }

    // 自身とフォローしているユーザIDを結合する
    public function eventGet($user_id, $follow_ids)
    {
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }

}
