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
        'time' => "required",
    );
}
