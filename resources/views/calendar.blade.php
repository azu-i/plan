@extends('layouts.layout')
@section('title','Home')
@section('content')
    <div class="flex-row">
        @foreach($lists as $userList)
            <button class="ml-2 mb-2 border-0" style="border-radius:10px; color:white; background-color: {{ $userList->color }};">{{ $userList->name }}</button>
        @endforeach
    </div>
    <div id="calendar" class="mt-10"></div>
    {{ csrf_field() }}

@endsection

