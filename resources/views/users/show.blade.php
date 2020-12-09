@extends('layouts.layout')
@section('title','登録情報')
@section('content')
<div class="conteiner">
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        @if($login_user->profile_image == null)
                        <img src={{ asset("image/profileimage.jpeg") }} class="rounded-circle" width="100" height="100">
                        @else
                            <img src={{ asset("storage/image/".$login_user->profile_image)}}   class="rounded-circle" width="100" height="100">
                        @endif
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex flex-column">
                            <div>
                                <a href="{{ url('users/' .$login_user->id .'/edit') }}"    class="btn btn-secondary">プロフィールを編集する</a>
                            </div>
                            <div class="user_info pt-3">
                                Name........<span>{{ $login_user->name }}</span><br>
                                Email.........<span>{{ $login_user->email }}</span><br>
                                @if($login_user->birthday == null)
                                    Birthday....<span>未登録</span><br>

                                @else
                                Birthday....<span>{{ $login_user->birthday }}</span><br>
                                @endif

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
