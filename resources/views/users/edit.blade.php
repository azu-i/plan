@extends('layouts.layout')
@section('title','edit')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー情報編集</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('UsersController@update', ['user_id '=> Auth::id() ]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row align-items-center">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">プロフィール画像</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <input type="file" name="profile_image" class="@error('profile_image') is-invalid @enderror" autocomplete="profile_image">
                                @error('profile_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">誕生日</label>

                            <div class="col-md-6">
                                <input type="date" value="date" class="form-control" name="birthday">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary">更新する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
