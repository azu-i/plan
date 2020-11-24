function addEvent(calendar,info){

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
