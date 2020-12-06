@extends('layouts.layout')
@section('title,登録情報')
@section('content')
<div class="conteiner">
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        <img src="{{ Auth::user()->profile_image }}" class="rounded-circle" width="100" height="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
