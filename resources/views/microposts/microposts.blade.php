@if (count($microposts) > 0)

    <ul class="list-unstyled">
        
        @foreach ($microposts as $micropost)
            
            <li class="media mb-3">
                
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class-"mr-2 rounded" src="{{ Gravatar::get($micropost->user->email, ['size' => 50]) }}" alt="">
                
                <div class="media-body">
                    
                    <div>
                        {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
                        
                        <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    
                    
                    <div>
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                    
                    
                    <div>
                        @if (Auth::id() == $micropost->user_id)
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' =>'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                    
                    
                </div>
                
            </li>
            
        @endforeach
        
    </ul>
    
    {{ $microposts->links() }}

@endif




{{--　コメント
class="text-muted"  は、文字の色を薄くしてる  muted の意味　くすんだ。鈍い、抑えた  


nl2brを使用することについて
 nl2br(e($micropost->content)) 
改行コードに改行タグを付ける
ソースコード上の改行はブラウザでは空白文字として扱われます。この関数を利用すれば、改行の部分に改行タグを挿入できます。
エスケープされないようにLaravel5では、{ と  !!　　　 !! と  }で囲む必要があります。

e() でエスケープをする

nl2br() で改行を<　br　>に置き換える

{　　!! 　　　　!!　　}で、<　br　>だけエスケープをせずに表示する


--}}