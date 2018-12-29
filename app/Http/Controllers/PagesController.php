<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\News;

class PagesController extends Controller
{
    public function home(News $news){
        $kouton = $news->where('column_id',1)->orderBy('updated_at','desc')->paginate(6);
        $industry = $news->where('column_id',2)->orderBy('updated_at','desc')->paginate(6);
        $think = $news->where('column_id',3)->orderBy('updated_at','desc')->paginate(6);
        $homebanners = Cache::rememberForever('home_banner', function (){
			return \DB::table('settings')->where('key','home_banner')->orderBy('updated_at','desc')->get();
        });
        return view('pages.home',compact('kouton','industry','think','homebanners'));
    }

    public function managernews(){
        return view('pages.managernews');
    }
}
