@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                    <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                
                {{-- ユーザ詳細タブ --}}
                <li class="nav-item">
                    <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
                        TimeLine<span class="badge badge-secondary">{{ $user->microposts_count }}</span>
                    </a>
                </li>
                
                {{-- フォロー一覧タブ --}}
                <li class="nav-item"><a href="#" class="nav-link">Followings</a></li>
                
                {{-- フォロワー一覧タブ --}}
                <li class="nav-item"><a href="#" class="nav-link">Followers</a></li>
                
            </ul>
            
            @if (Auth::id() == $user->id)
                @include('microposts.form') 
            @endif
            
            @include('microposts.microposts')
            
        </div>
    </div>
@endsection


{{--  

ログインユーザ自身の詳細ページである場合は投稿フォームも設置します

ユーザの投稿の一覧は、ログインユーザ自身じゃなくても　ほかのユーザも見れます
--}}