@extends('layouts.layout')
@section('title','Plan')
@section('content')
<div class = "container">
    <div class = "row">
        <div class = "col-md-8 mx-auto">
            <h2>予定登録</h2>
            <form action="{{ action('PlanController@postPlan') }}" method="post" enctype="multipart/form-data">
            <form  method = "POST">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-7">予定名  ※</label>

                    <div  class="col-md-10">
                        <input type="text" class="form-control" name="event_name" value="{{ old('even_name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-7">予定アイコン</label>
                        <div class="checkbox">
                            <label class="checkbox-inline">
                                <input src="" type="checkbox" name="checkbox[]" value="1"><img src="image/cake.jpeg" alt="誕生日アイコン">誕生日
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="checkbox[]" value="2"><img src="image/food.jpeg" alt="食事アイコン">食事
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="checkbox[]" value="3"><img src="image/hairsalon.jpeg" alt="美容院アイコン">美容院
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="checkbox[]" value="4"><img src="image/beer.jpeg" alt="飲み会アイコン">飲み会
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="checkbox[]" value="5"><img src="image/calendar.png" alt="その他予定アイコン">その他予定
                            </label>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-7">日付  ※</label>
                    <div class="col-md-10">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>"class="form-control" name="date" value="{{ old('date') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-7">時間</label>
                    <div class="col-md-10">
                       <input type="time" class="form-control" name="time" value="{{ old('time') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-7">詳細</label>
                    <div class="col-md-10">
                       <textarea class="form-control" name="detail" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label>※は入力必須</label>
                </div>
                 {{ csrf_field() }}
                <input type="submit" class="form-group row btn btn-secondary" value="登録">
           </form>
        </div>
    </div>
    <div class="row pt-4">
        <div class="list-plans col-md-12 mx-auto">
            <div class="row">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>予定名</th>
                            <th>日程</th>
                            <th>時間</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $plan)

                            <tr>
                                <th>{{ $plan->event_name }}</th>
                                <th>{{ $plan->date }}</th>
                                <th>{{ $plan->time }}</th>
                                <td>
                                    <div>
                                        <a  class="btn btn-secondary" href="{{ action('PlanController@delete', ['id' => $plan->id]) }}">削除</a>

                                        {{ csrf_field() }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
