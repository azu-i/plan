<?php

namespace App\Http\Controllers\Follower\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerAcceptController extends Controller
{
    //
    public function index(){
        $query = \App\Follower::query();
        return $query->get();
    }

    public function accept(Request $request) {
        $followed = \App\Follower::find($request->id);
        $followed->accepted = $request->accept;
        $result = $followed->save();
        return ['result' => $result];
    }
}
