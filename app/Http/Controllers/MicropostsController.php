<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
    
    public function index()
    {
        $data = [];
        if(\Auth::check()) {
            $user = \Auth::user();
            $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'microposts'=> $microposts,
                ];
        }
        
        return view('welcome',$data);
    }
    
    /**
     * storeアクション
     * 
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);
        
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）storeアクションでは create メソッドを使ってMicropostを保存
        $request->user()->microposts()->create([
            
            'content' => $request->content,
            
            ]);
        
        // 前のURLへリダイレクトさせる この store アクションの場合、リクエスト元の投稿フォームのページへ戻ることになります。
        return back();
    }
    
    /**
     * destroyアクション
     * 
     */
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $micropost = \App\Micropost::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }
        
        // 前のURLへリダイレクトさせる
        return back();
    }
    
}
