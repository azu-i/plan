<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\User;
use Carbon\Carbon;
use App\Follower;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    //カレンダーへの予定表示
    //@param App/Follower $follower
    //@return $newArr(予定のタイトル・時間・予定の色)
    //               (誕生日の表示)
    public function setEvents(Follower $follower)
    {
        $this->carbon = new Carbon;
        $user = Auth::user();
        $user_id = $user->id;

        // followed_idだけ抜き出す
        $follow_ids = $follower->followingIds($user->id);
        //ログイン中のfollowing_idに紐づくfollowed_idをarrayで取り出す
        $followed_ids = $follow_ids->pluck('followed_id')->toArray();
        array_push($followed_ids ,$user_id);

        //イベントを取得
        if($followed_ids != null){
            $events = Plan::whereIn('user_id', $followed_ids)->select('user_id','id', 'event_name', 'date','time')->get();
        }else{
            $events = Plan::where('user_id', $user->id)->whereBetween('date', [$start, $end])->select('user_id','id', 'event_name', 'date','time')->get();
        }

        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する
        $newArr = [];
        foreach($events as $item){
            $newItem["title"] = $item["event_name"];
            // 時間設定がある場合は時間も表示
            if($item["time"] != null){
                $newItem["start"] = $item["date"] . "T" . $item["time"];
            }else{
                $newItem["start"] = $item["date"];
            }
            // イベントの色の設定
            // #0099FF=青
            if($item["user_id"] == $user_id){
                $newItem["color"] = "#0099FF";
            }else{
                $result = array_search($item["user_id"], $followed_ids);
                // #008000=緑 #6a5acd=紫 #b22222=赤茶 #696969=グレイ #ff69b4=ピンク
                $event_color = ['#008000','#6a5acd','#b22222','#696969','#ff69b4'];
                $newItem["color"] = $event_color[$result];
            }
            $newArr[] = $newItem;
        }

        //誕生日の設定
        if($followed_ids != null){
            $birthdays = User::whereIn('id', $followed_ids)->select('birthday','name')->get();
        }else{
            $birthdays = User::where('id', $user->id)->select('birthday','name')->get();
        }


        foreach($birthdays as $birthday){
            if($birthday["birthday"]!=null){
                $newItem["title"] = $birthday["name"] . "の誕生日";
                [$year, $month, $day] = explode("-", $birthday["birthday"]);
                $newItem["start"] = date("Y") . "-" . $month . "-" . "$day";
                // 色はワインレッド
                $newItem["color"] = "#BC2768";
                $newArr[] = $newItem;
            }
        }
        echo json_encode($newArr);
    }


    public function addEvent(Request $request)
    {
        $data = $request->all();
        $event = new Plan();
        $event->id = $this->generateId();
        $event->date = $data['date'];
        $event->event_name = $data['event_name'];
        $event->time = $data['time'];
        $event->save();

        return response()->json(['id' => $event->id ]);
    }

    // ajaxで受け取ったデータをデータベースに追加し、今度はidを返す。
    public function editEventDate(Request $request)
    {
        $data = $request->all();
        $event = Plan::find($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;
    }


    //カレンダーview表示への色表示
    //@param $follower
    //@return $lists ユーザーに合わせた色
    public function calendar(Follower $follower)
    {
        $auth = Auth::user();
        $authuser_id = $auth->id;

        // followed_idだけ抜き出す
        $follow_ids = $follower->followingIds($authuser_id);
        //ログイン中のfollowing_idに紐づくfollowed_idをarrayで取り出す
        $followed_ids = $follow_ids->pluck('followed_id')->toArray();
        array_push($followed_ids ,$authuser_id);
        $lists = array();

        //カレンダーの期間内のイベントを取得
        if($followed_ids !== null){
            $lists= User::whereIn('id', $followed_ids)->select('id','name')->get();
        }else{
            $lists = User::where('id', $authuser_id)->select('id','name')->get();
        }
        foreach($lists as $list){
            if($list["id"] == $authuser_id){
                $list["color"] = "#0099FF";
            }else{
                $result = array_search($list["id"], $followed_ids);
                // #008000=緑 #6a5acd=紫 #b22222=赤茶 #696969=グレイ #ff69b4=ピンク
                $event_color = ['#008000','#6a5acd','#b22222','#696969','#ff69b4'];
                $list["color"] = $event_color[$result];
            }
        }
        return view('calendar',['lists' => $lists]);
    }
}
