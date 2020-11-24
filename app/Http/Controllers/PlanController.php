<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Plan;

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
        $form = $request->all();

        $plan -> date = $request->date;
        $plan -> event_name = $request -> event_name;

        unset($form['_token']);
        $plan -> fill($form);
        $plan -> save();


        return redirect("/plan");
    }

    //Plan履歴
    public function planHistory(Request $request){
        $search = $request -> search;
        if($search != ''){
            $posts = Plan::where('event_name',$search) -> get();
        }else{
            $posts = Plan::all();

        }
        return view('plan',['posts'=>$posts, 'search'=>$search]);
    }

    //Plan削除
    public function delete(Request $request){
        $plan = Plan::findOrFail($request->id);
        $plan -> delete();
        return redirect('/plan');
    }

}
