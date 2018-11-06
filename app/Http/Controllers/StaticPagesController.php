<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home(){
        return view('wwwlayouts.home');
    }
    public function managernews(){
        return view('wwwlayouts.managernews');
    }
}
