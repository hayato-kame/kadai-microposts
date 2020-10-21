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
            $microposts = $user->microposts()->orderBy('created\at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'microposts'=> $microposts,
                ];
        }
        
        return view('welcome',$data);
    }
}
