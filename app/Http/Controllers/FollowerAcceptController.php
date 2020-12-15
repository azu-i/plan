<?php

namespace App\Http\Controllers\Follower;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Follower;

class FollowerAcceptController extends Controller
{

    public function accept(Request $request) {
        $followed = Follower::find($request->followed_id);
        dd($followed);
        $followed->accepted = $request->accept;
        $result = $followed->save();
        return ['result' => $result];
    }
}
