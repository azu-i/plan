@extends('layouts.layout')
@section('title','Home')
@section('content')
    <div id="calendar" class="mt-10"></div>
    {{ csrf_field() }}
@endsection
