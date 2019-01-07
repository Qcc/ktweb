<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Cache;
use App\Models\Column;
class ColumnsController extends Controller
{
    public function show(Column $column, Request $request, News $news)
    {
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $newss = $news->withOrder($request->order)
                        ->where('column_id',$column->id)
                        ->paginate(15);
        // 读取分类 banner有值的文章，首页显示
        $banners = Cache::rememberForever('news_banners', function () use($request, $news){
			return $news->withOrder($request->order)
                        ->whereNotNull('banner')
                        ->paginate(6);
        });
        
        // 传参变量话题和分类 到模版中
        return view('pages.news.index',compact('newss','column','banners'));
    }
}
