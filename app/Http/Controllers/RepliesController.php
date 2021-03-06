<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Illuminate\Support\Facades\Cache;

use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * 保存社区话题回复
	 *
	 * @param ReplyRequest $request
	 * @return void
	 */
	public function store(ReplyRequest $request, Reply $reply)
	{
		$reply->content = $request->content;
		$reply->user_id = Auth::id();
		$reply->topic_id = $request->topic_id;
		$reply->save();
		$topic = $reply->topic;
		// 如果文章是置顶文章，更新缓存
		updateTopCache($topic);
		return redirect()->to($reply->topic->link(['#reply' . $reply->id]))->with('success', '回复成功！');
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->to($reply->topic->link())->with('success', '删除成功.');
	}
}