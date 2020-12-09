@extends('layouts.layout')
@section('title','ユーザー一覧')
@section('content')
    <div class="conteiner">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @foreach($all_users as $user)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @if($user->profile_image == null)
                            <img src={{ asset("image/profileimage.jpeg") }} class="rounded-circle" width="50" height="50">
                            @else
                            <img src={{ asset("storage/image/".$user->profile_image)}}   class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $user->name }}</p>
                            </div>
                            @if(auth()->user()->isFollowing($user))
                            <div class="px-2">
                                <span class="px-1 bg-secondary text-light">フォロー中</span>
                            </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                @if(auth()->user()->isFollowing($user))
                                    <a  class="btn btn-danger" href="{{ action('UsersController@unfollow', ['id' => $user->id]) }}">フォロー解除</a>

                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                @else
                                    <a  class="btn btn-secondary" href="{{ action('UsersController@follow', ['id' => $user->id]) }}">フォローする</a>
                                    {{ csrf_field() }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>
@endsection
