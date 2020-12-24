

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');


    var calendar = new FullCalendar.Calendar(calendarEl, {
        eventSources: [
            {
            googleCalendarApiKey: 'AIzaSyC_qr8J9tGVhIze_ZeGiHFebfwjRRGc9Q8',
            googleCalendarId: 'ja.japanese#holiday@group.v.calendar.google.com',
            className: 'holiday',
            color:'red',
            textColor: 'white',
          },

        ],
        //24時間表示
        eventTimeFormat: {
            hour: "2-digit",
            minute: "2-digit",
            meridiem: false,
            hour12: false
        },

        defaultView: 'dayGridMonth',
        height: 700 ,
        editable: true,
        //1→月曜日始まり、0→日曜日始まり
        firstDay : 0,

        headerToolbar: {
            right: "prev,next"
          },

        // スマホでタップしたとき即反応
        selectLongPressDelay:0,

        events: "/setEvents",


    });
    calendar.render();

});


