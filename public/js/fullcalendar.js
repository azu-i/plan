document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        eventSources: [
            {
            googleCalendarApiKey: 'AIzaSyC_qr8J9tGVhIze_ZeGiHFebfwjRRGc9Q8',
            googleCalendarId: 'ja.japanese#holiday@group.v.calendar.google.com',
            className: 'holiday',
            color:'white',
            textColor: 'red',
          },

        ],
        defaultView: 'dayGridMonth',
        height: 700 ,
        editable: true,
        displayEventTime: true,
        // displayEventEnd:true,
        timeFormat:"HH:mm",
        //1→月曜日始まり、0→日曜日始まり
        firstDay : 0,
        headerToolbar: {
            left: "dayGridMonth,listMonth",
            center: "title",
            right: "today prev,next"
          },

        //イベントの期間変更
        eventDurationEditable : false,
        // スマホでタップしたとき即反応
        selectLongPressDelay:0,

        events: "/setEvents",
        eventColor: '#FF9999',

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


