<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//  必ずこれを追加する
use App\User; // 追加

class UsersController extends Controller
{
    public function index()
    {
      
      
        $users = User::orderBy('id', 'desc')->paginate(10);


        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
      
      
        $user = User::findOrFail($id);
        
        
        
        $user->loadRelationshipCounts();
      
      
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        

        
        
        
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
    
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
     public function followings($id)
     {
         // idの値でユーザを検索して取得
         $user = User::findOrFail($id);
         
         // 関係するモデルの件数をロード
         $user->loadRelationshipCounts();
         
         // ユーザのフォロー一覧を取得
         $followings = $user->followings()->paginate(10);
         
         // フォロー一覧ビューでそれらを表示
         return view('users.followings', [
             'user' => $user,
             'users' => $followings,
             ]);
     }
    
    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
     
     public function followers($id)
     {
         // idの値でユーザを検索して取得
         $user = User::findOrFail($id);
         
         // 関係するモデルの件数をロード
         $user->loadRelationshipCounts();
         
         // ユーザのフォロワー一覧を取得
         $followers = $user->followers()->paginate(10);
         
         // フォロワー一覧ビューでそれらを表示
         return view('users.followers', [
             'user' => $user,
             'users' => $followers,
             ]);
     }
     
     /**
     * ユーザのお気に入り一覧ページを表示するアクション。
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function favorites($id)
    {
        // idの値でユーザを検索して取得
         $user = User::findOrFail($id);
         
         // 関係するモデルの件数をロード
         $user->loadRelationshipCounts();
         
         $microposts = $user->favorites()->paginate(10);
         
         return view('users.favorites',[
             'user' => $user,
             'microposts' => $microposts,
             ]);
    }
}
