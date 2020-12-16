<?php

namespace App\Http\Controllers\Follower;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Follower;

class FollowerAcceptController extends Controller
{

    public function accept(Request $request) {
        $followAccept = Follower::find($request->id);
        $followAccept->accepted = $request->accept;
        $result = $followAccept->save();
        return ['result' => $result];
    }
}
