<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * 根据分类获取对应分类下的 话题
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category, Request $request, Topic $topic)
    {
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $topics = $topic->withOrder($request->order)
                        ->where('category_id',$category->id)
                        ->paginate(20);
        // 传参变量话题和分类 到模版中
        return view('topics.index',compact('topics','category'));
    }
}
