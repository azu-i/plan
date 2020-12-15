<?php

namespace App\Http\Controllers\Follower;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerAcceptController extends Controller
{
    //
    public function index(){
            return view('follow.userList');
        }
}
