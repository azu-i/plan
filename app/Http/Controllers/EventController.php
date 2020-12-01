<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Carbon\Carbon;
use App\Follower;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function setEvents(Request $request, Follower $follower){
        $this->carbon = new Carbon;
        $user = Auth::user();
        // followed_idだけ抜き出す
        $follow_ids = $follower->followingIds($user->id);
        //ログイン中のfollowed_idに紐づくfollowing_idをarrayで取り出す
        $following_ids = $follow_ids->pluck('followed_id')->toArray();

        // 期間の始まりと終わり
        $start = $this->carbon->copy()->startOfWeek();
        $end = $this->carbon->copy()->endOfWeek();

        //カレンダーの期間内のイベントを取得
        $events = Plan::whereIn('user_id', [$follow_ids, $following_ids])->whereBetween('date', [$start, $end])->select('id', 'event_name', 'date','time')->get();
        // $events = Plan::where('user_id', $user_id)->whereBetween('date', [$start, $end])->select('id', 'event_name', 'date','time')->get();

        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する
        $newArr = [];
        foreach($events as $item){
            $newItem["title"] = $item["event_name"];
            $newItem["time"] = $item["time"];
            $newItem["start"] = $item["date"] ;
            $newArr[] = $newItem;
        }

        echo json_encode($newArr);
    }

    public function formatDate($date){
        return str_replace('T00:00:00+09:00', '', $date);
    }
    // "2019-12-12T00:00:00+09:00"のようなデータを今回のDBに合うように"2019-12-12"に整形

    public function addEvent(Request $request)
    {
        $data = $request->all();
        $event = new Plan();
        $event->id = $this->generateId();
        $event->date = $data['date'];
        $event->event_name = $data['event_name'];
        $event->save();

        return response()->json(['id' => $event->id ]);
    }

    // ajaxで受け取ったデータをデータベースに追加し、今度はidを返す。
    public function editEventDate(Request $request){
        $data = $request->all();
        $event = Plan::find($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;
    }


    public function calendar(){
        return view('calendar');
    }
}
