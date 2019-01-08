<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Column;
use App\Http\Requests\NewsRequest;
use Auth;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\BatchCreateSeoNews;
use App\Models\Customer;
use App\Models\Product;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(News $news, Request $request)
    {
		// 分页获取21条记录。默认获取15条
		$newss = $news->withOrder($request->order)->paginate(15);
        // 读取分类 banner有值的文章，首页显示
        $banners = Cache::rememberForever('news_banners', function () use($request, $news){
			return $news->withOrder($request->order)
                        ->whereNotNull('banner')
                        ->paginate(6);
        });
		return view('pages.news.index', compact('newss','banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(News $news)
    {
        $this->authorize('create',$news);
        $columns = Column::all();
		return view('pages.news.create_and_edit', compact('news', 'columns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request, News $news)
    {
        $this->authorize('create',$news);
        // 行业资讯和管理智库允许批量发布SEO填充文章
        if($request->column_id != 1 && $request->seo){
            $citys = Cache::rememberForever('soe_citys', function (){
                return \DB::table('seos')->get();
            });
            $articles = [];
            foreach($citys as $city){
                $title = str_replace('**',$city->city,$request->title);
                $body = str_replace('**',$city->city,$request->body);
                $keywords = str_replace('**',$city->city,$request->keywords);  
                $article = [];
                $article['title']= $title;
                $article['image'] = $request->image;
                $article['body'] = $body;
                $article['user_id']= Auth::id();
                $article['column_id']= $request->column_id;
                $article['keywords']= $keywords;
                // 批量生成SEO文章 耗时任务推送到队列执行
                dispatch(new BatchCreateSeoNews($article));
            }
        }else{
            $news->fill($request->all());
            $news->user_id = Auth::id();
            $news->save();
        }
        Cache::forget('news_banners');
		return redirect()->to($news->link())->with('success', '成功创建文章！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, News $news)
    {
        $advertisings = Cache::rememberForever('side_advertising', function (){
			return \DB::table('settings')->where('key','side_advertising')->get();
        });
        $customers = Customer::orderby('updated_at','desc')->paginate(5);
        $products = Product::orderby('updated_at','desc')->paginate(5);
        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($news->slug) && $news->slug != $request->slug) {
            return redirect($news->link(), 301);
        }
        return view('pages.news.show', compact('news','advertisings','customers','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $this->authorize('update', $news);
		$columns = Column::all();
		return view('pages.news.create_and_edit', compact('news','columns'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $this->authorize('update', $news);
		$news->update($request->all());
        Cache::forget('news_banners');
		return redirect()->to($news->link())->with('success', '文章更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $this->authorize('destroy', $news);
		$news->delete();

		return redirect()->route('news.index')->with('message', '删除成功.');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
	{
		//初始化数据,默认是失败的
		$data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
		// 判断是否有文件上传，并赋值给$file
		if($file = $request->upload_file){
			// 保存图片到本地
			$result = $uploader->save($request->upload_file,'news',\Auth::id(),1920);
			//图片保存成功的话
			if($result){
				$data['success'] = true;
				$data['file_path'] = $result['path'];
				$data['msg'] = '上传成功!';
			}
		}
		return $data;
	}
}
