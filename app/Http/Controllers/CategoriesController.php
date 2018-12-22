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
        //获取置顶文章
        $tops = $topic->withOrder($request->order)
                      ->where('topping', 1)
                      ->where('category_id',$category->id)              
                      ->get();
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $topics = $topic->withOrder($request->order)
                        ->where('category_id',$category->id)
                        ->paginate(20);
        // 传参变量话题和分类 到模版中
        return view('topics.index',compact('topics','category','tops'));
    }

    public function update(Request $request,Category $category)
    {
        $data = [
            'code'=>0,
            'msg'=>'类目更新成功!'
        ];
        $category = Category::find($request->id);
        $category->update($request->all());
        return $data;
    }

    public function store(Request $request, Category $category)
	{
        $data = [
            'code'=>0,
            'msg'=>'新建类目成功!'
        ];
		$category->fill($request->all());
		$category->save();
		return $data;
    }
    
    public function destroy(Request $request, Category $category)
	{
        $data = [
            'code'=>0,
            'msg'=>'删除类目成功!'
        ];
		$category = Category::find($request->id);
		$category->delete();
		return $data;
	}
}
