<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    //view表示
    public function getPlan(Request $request)
    {
        return view("plan");
    }

    //Plan投稿
    public function postPlan(Request $request)
    {
        $this->validate($request, Plan::$rules);

        $plan = new Plan();
        // $form = $request->all();

        $plan -> date = $request -> date;
        $plan -> event_name = $request -> event_name;
        $plan->user_id = $request->user()->id;

        unset($form['_token']);
        // $plan -> fill($form);
        $plan -> save();


        return redirect("/plan");
    }

    //Plan履歴
    public function planHistory(){
            $user_id = Auth::id();
            $posts = Plan::where('user_id', $user_id)->get();

            return view('plan',['posts'=>$posts]);
    }

    //Plan削除
    public function delete(Request $request){
        $plan = Plan::findOrFail($request->id);
        $plan -> delete();
        return redirect('/plan');
    }

}
