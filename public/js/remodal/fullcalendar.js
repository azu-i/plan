document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid' ],
        //プラグイン読み込み
        defaultView: 'dayGridMonth',
        //カレンダーを月ごとに表示
        editable: true,
        //イベント編集
        firstDay : 1,
        //秋の始まりを設定。1→月曜日。defaultは0(日曜日)
        eventDurationEditable : false,
        //イベントの期間変更
        selectLongPressDelay:0,
        // スマホでタップしたとき即反応
        events: [
            {
                title: 'イベント',
                start: '2019-01-01'
            }
        ],
        //一旦イベントのサンプルを表示。動作確認用。

        eventDrop: function(info){
        //eventをドラッグしたときの処理
             //editEventDate(info);
            //あとで使う関数
        },

        dateClick: function(info) {
        //日付をクリックしたときの処理
            //addEvent(calendar,info);
            //あとで使う関数


        },
    });
    calendar.render();

    events: "/setEvents";

    function addEvent(calendar,info){
        //addEvent()を使うためにfullcalendar.jsで定義したcalendarを引数で受け取る

        var title = "サンプルイベント";
        //ホントはjsでformのvalue取得とかするんだと思いますが、説明を簡潔にするために割愛します。
        $.ajax({
            url: '/ajax/addEvent',
            type: 'POST',
            dataTape: 'json',
            data:{
                "title":title,
                "date":info.dateStr
                //日程取得
            }
        }).done(function(result) {
            calendar.addEvent({
                id:result['event_id'],
                //php側から受け取ったevent_idをeventObjectのidにセット
                title:title,
                start: info.dateStr,
            });
            //ajaxに成功したらフロント側にeventを追加で表示
        });
    }

    function editEventDate(info){
        var event_id = info.event.id;
        var date = formatDate(info.event.start);

        $.ajax({
            url: '/ajax/editEventDate',
            type: 'POST',
            data:{
                "id":event_id,
                "newDate":date
                //ドロップしたあとの日付をphp側に渡す
            }
        })
    }

    function formatDate(date) {
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var newDate = year + '-' + month + '-' + day;
        return newDate;
    }
});

