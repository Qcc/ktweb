<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class PagesController extends Controller
{
    public function home(News $news){
        $kouton = $news->where('column_id',1)->paginate(6);
        $industry = $news->where('column_id',2)->paginate(6);
        $think = $news->where('column_id',3)->paginate(6);
        return view('pages.home',compact('kouton','industry','think'));
    }
    public function managernews(){
        return view('pages.managernews');
    }
}
