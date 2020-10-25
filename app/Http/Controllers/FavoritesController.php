<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * 投稿をお気に入りにするアクション。
     *
     * @param  $micropostId
     * @return \Illuminate\Http\Response
     */
    public function store($micropostId)
    {
        \Auth::user()->favorite($micropostId);
        return back();
    }
    
     /**
     * 投稿をお気に入りからはずすアクション。
     *
     * @param  $micropostId
     * @return \Illuminate\Http\Response
     */
     public function destroy($micropostId){
         \Auth::user()->unfavorite($micropostId);
         return back();
     }
}
