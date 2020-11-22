@extends('layouts.layout')
@section('title','Home')
@section('content')
    <div id="calendar"></div>
    {{ csrf_field() }}
@endsection
