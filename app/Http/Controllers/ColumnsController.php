<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Column;
class ColumnsController extends Controller
{
    public function show(Column $column, Request $request, News $news)
    {
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $newss = $news->withOrder($request->order)
                        ->where('column_id',$column->id)
                        ->paginate(21);
        // 传参变量话题和分类 到模版中
        return view('pages.news.index',compact('newss','column'));
    }
}
