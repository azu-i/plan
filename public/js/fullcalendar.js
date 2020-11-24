document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        defaultView: 'dayGridMonth',
        height: 700 ,
        //イベント編集
        editable: true,
        //1→月曜日始まり、0→日曜日始まり
        firstDay : 0,
        //イベントの期間変更
        eventDurationEditable : false,
        // スマホでタップしたとき即反応
        selectLongPressDelay:0,

        events: "/setEvents",

        eventDrop: function(info){
            //eventをドラッグしたときの処理
            //editEventDate(info);
            //あとで使う関数
        },

        dateClick: function(info) {
            //日付をクリックしたときの処理
            // addEvent(calendar,info);
            //あとで使う関数


        },

    });
    calendar.render();

});


