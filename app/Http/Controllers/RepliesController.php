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
		return redirect()->to($reply->topic->link(['#reply' . $reply->id]))->with('success', '回复成功！');
	}
	public function greatReply(Request $request,Reply $reply){
		$data = [
			'msg'=>'点赞失败!',
			'success' => false
		];
		if (!Cache::has('greats')) {
			Cache::forever('greats',[]);
		}
		$userid = Auth::id();
		$greats = Cache::get('greats');
		$reply = Reply::find($request->reply_id);
		if(in_array($userid,$greats)){
			$reply->decrement ('great_count');
			$key = array_search($userid, $greats);
			if ($key !== false){
				array_splice($greats, $key, 1);
			}
			$greats = Cache::forever('greats',$greats);
			$data = [
				'msg'=>'取消点赞成功!',
				'success' => true,
				'action' =>'delete'
			];		
		}else{
			$reply->increment ('great_count');
			array_push($greats,$userid);
			$greats = Cache::forever('greats',$greats);
			$data = [
				'msg'=>'点赞成功!',
				'success' => true,
				'action' =>'add'
			];
		}
		return $data;
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->to($reply->topic->link())->with('success', '删除成功.');
	}
}