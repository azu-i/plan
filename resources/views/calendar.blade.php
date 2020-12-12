@extends('layouts.layout')
@section('title','Home')
@section('content')
@foreach($lists as $list)
   <div>
       
   </div>
@endforeach
    <div id="calendar" class="mt-10"></div>
    {{ csrf_field() }}
@endsection

