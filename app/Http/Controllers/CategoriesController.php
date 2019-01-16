<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

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
        //获取置顶文章
		$tops =  [];
		$keys =  Redis::keys('topic_'.$category->id.'_*');
		foreach ($keys as $key) {
			array_push($tops,unserialize(Redis::get($key)));
		}
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $topics = $topic->withOrder($request->order)
                        ->where('category_id',$category->id)
                        ->paginate(20);
        // 热门主题，点赞最多的主题 每天更新
		$hottopics = Cache::remember('hottopics',60*24,function () use($topic){
			return $topic->orderBy('great_count','desc')->paginate(8);
        });
        // 热门主题，点赞最多的主题 每天更新
		$replysmores = Cache::remember('replysmores',60*24,function () use($topic){
			return $topic->orderBy('reply_count','desc')->paginate(8);
        });
        // 侧边栏广告
		$advertisings = Cache::rememberForever('side_advertising', function (){
			return \DB::table('settings')->where('key','side_advertising')->get();
        });
        // 传参变量话题和分类 到模版中
        return view('topics.index',compact('topics','category','tops','hottopics','replysmores','advertisings'));
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
