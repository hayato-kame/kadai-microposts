@extends('layouts.app')

@section('content')
    <div class="row">
        
        <aside class="col-sm-4">
            @include('users.card')
            
        </aside>
        
        <div class="col-sm-8">
            @include('users.navtabs')
            
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