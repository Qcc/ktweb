<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Column;
use App\Http\Requests\NewsRequest;
use Auth;

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
		$newss = $news->withOrder($request->order)->paginate(21);

		return view('pages.news.index', compact('newss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(News $news)
    {
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
        $news->fill($request->all());
		$news->user_id = Auth::id();
		$news->save();
		return redirect()->to($news->link())->with('success', '成功创建话题！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, News $news)
    {
        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($news->slug) && $news->slug != $request->slug) {
            return redirect($news->link(), 301);
        }
        return view('pages.news.show', compact('news'));
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

		return redirect()->to($news->link())->with('success', '话题更新成功！');
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
}
