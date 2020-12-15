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
                            @if(Auth::user()->isFollowing($user))
                            <div class="px-2">
                                @if(!$user->accepted)
                                @elseif(Auth::user()->isAccepted($user)->accepted == 'true')
                                <span class="px-1 bg-secondary text-light">フォロー中</span>
                                @else
                                <span class="px-1 bg-secondary text-light">承認待ち</span>
                                @endif
                            </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                @if(Auth::user()->isFollowing($user))
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script> --}}
    {{-- <script>
        new Vue({
            el: '#app',
            data: {
                followers: []
            },
            methods: {
                getFollowers() {
                    const url = '/admin/ajax/user_accept';
                    axios.get(url)
                        .then(response => {
                            this.followers = response.data;
                          });
                },
                accept(followedId, accepted) {
                    if(confirm('承認状態を変更します。よろしいですか？')) {
                        const url = '/follower/ajax/follower_accept/accept';
                        const params = {
                            followed_id: followedId,
                            accept: accepted
                        };
                        axios.post(url, params)
                            .then(response => {
                                if(response.data.result)
                                    this.getFollowers();
                                }
                            });
                    }
                }
            },
            mounted() {
                this.getFollowers()
            }
        });
    </script> --}}
@endsection
