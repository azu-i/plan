<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Carbon\Carbon;

class EventController extends Controller
{

    public function setEvents(Request $request){
        $this->carbon = new Carbon;
        // $start = $this->formatDate($request->all()['start']);
        // $end = $this->formatDate($request->all()['end']);
        $start = $this->carbon->copy()->startOfWeek();
		$end = $this->carbon->copy()->endOfWeek();
        //表示した月のカレンダーの始まりの日を終わりの日をそれぞれ取得。

        $events = Plan::select('id', 'event_name', 'date')->whereBetween('date', [$start, $end])->get();
        //カレンダーの期間内のイベントを取得

        $newArr = [];
        foreach($events as $item){
            $newItem["event _name"] = $item["event_name"];
            $newItem["time"] = $item["time"];
            $newItem["start"] = $item["date"];
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する

        echo json_encode($newArr);
        // json形式にして出力
        return view('calendar');
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
}
