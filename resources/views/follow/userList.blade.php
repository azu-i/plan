@extends('layouts.layout')
@section('title','ユーザー一覧')
@section('content')
    <div class="conteiner">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @foreach($all_users as $user)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex pl-4">
                            @if($user->profile_image == null)
                            <img src={{ asset("image/profileimage.jpeg") }} class="rounded-circle" width="50" height="50">
                            @else
                            <img src={{ asset("storage/image/".$user->profile_image)}}   class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="ml-2 d-flex flex-column pl-2">
                                <p class="mb-0">{{ $user->name }}</p>
                            </div>
                            @if(Auth::user()->isFollowing($user))
                            <div class="px-2">
                                @if(Auth::user()->isAccepted($user))
                                <span class="px-1 bg-secondary text-light">フォロー中</span>
                                @else
                                <span class="px-1 bg-secondary text-light">承認待ち</span>
                                @endif
                            </div>
                            @endif

                            @if($user->isFollowing(Auth::user()))
                            @if(!$user->isAccepted(Auth::user()))
                            <a  class="btn btn-danger h-25 ml-2" href="{{ action('UsersController@unfollow', ['id' => $user->id]) }}">承認しない</a>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a  class="btn btn-danger h-25 ml-1" href="{{ action('FollowerAcceptController@accept', ['id' => $user->id]) }}">承認する</a>
                            @endif
                            @endif

                            <div class="d-flex justify-content-end flex-grow-1">
                                @if(Auth::user()->isFollowing($user))
                                    <a  class="btn btn-danger h-70" href="{{ action('UsersController@unfollow', ['id' => $user->id]) }}">フォロー解除</a>
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                @else
                                    <a  class="btn btn-secondary h-70" href="{{ action('UsersController@follow', ['id' => $user->id]) }}">フォローする</a>
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
