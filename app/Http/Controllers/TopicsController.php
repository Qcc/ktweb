<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Session\Store as Session;
use App\Handlers\ImageUploadHandler;
use App\Notifications\ReportNotice;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use Auth;

class TopicsController extends Controller
{
	public $session;
    public function __construct(Session $session)
    {
		$this->session = $session;
		// 'except' => ['index', 'show'] —— 对除了 index() 和 show() 以外的方法使用 auth 中间件进行认证。
		// 使用其余方法需要登录
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


	// $request->order 是获取 URI http://keweb.test/topics?order=recent 中的 order 参数
	public function index(Request $request, Topic $topic)
	{
		// 社区首页banner图
		$clubbanners = Cache::rememberForever('club_banner', function (){
			return \DB::table('settings')->where('key','club_banner')->orderBy('updated_at','desc')->get();
		});
		// 热门主题，点赞最多的主题 每天更新
		$hottopics = Cache::remember('hottopics',60*24,function () use($topic){
			return $topic->orderBy('great_count','desc')->paginate(8);
        });
		// 热门主题，回复最多的主题 每天更新
		$replysmores = Cache::remember('replysmores',60*24,function () use($topic){
			return $topic->orderBy('reply_count','desc')->paginate(8);
		});
		// 侧边栏广告
		$advertisings = Cache::rememberForever('side_advertising', function (){
			return \DB::table('settings')->where('key','side_advertising')->get();
        });
		//获取置顶文章
		$tops =  [];
		$keys =  Redis::keys('topic_*');
		foreach ($keys as $key) {
			array_push($tops,unserialize(Redis::get($key)));
		}
		// 分页获取20条记录。默认获取15条
		$topics = $topic->withOrder($request->order)->paginate(20);

		return view('topics.index', compact('topics','tops','clubbanners','hottopics','replysmores','advertisings'));
	}

	/**
	 * 我们需要访问用户请求的路由参数 Slug，在 show() 方法中我们注入 $request；
	 * ! empty($topic->slug) 如果话题的 Slug 字段不为空；
	 * && $topic->slug != $request->slug 并且话题 Slug 不等于请求的路由参数 Slug；
	 * redirect($topic->link(), 301) 301 永久重定向到正确的 URL 上。
	 * 例如 用户访问 http://ktweb.test/topics/119
	 * 将被强制重定向到 http://ktweb.test/topics/119/title-test
	 *
	 * @param Request $request
	 * @param Topic $topic
	 * @return void
	 */
    public function show(Request $request, Topic $topic)
    {
		// 根据会话阅读增加文章访问量
		if (!$this->session->has('topic_'.$topic->id))
		{
			$topic->timestamps = false;
			$this->session->put('topic_'.$topic->id,$topic->id);
			$topic->increment('view_count');
			$topic->timestamps = true;
			// 如果文章是置顶文章，更新缓存
			updateTopCache($topic);
		}
		// 判断文章是否是置顶文章
		if(Redis::exists('topic_'.$topic->category->id.'_'.$topic->id)){
			$topic->topping = true;
		}
		$topics = $topic->user->topics()->with('category')->recent()->paginate(5);
		$advertisings = Cache::rememberForever('side_advertising', function (){
			return \DB::table('settings')->where('key','side_advertising')->get();
		});
		// 更多内容
		$moreTopics = $topic->find([$topic->id - 2,$topic->id - 3,$topic->id - 4,$topic->id - 5,$topic->id - 6]);
		
		// 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
		}
		// dd(compact('advertisings'));
        return view('topics.show', compact('topic','topics','advertisings','moreTopics'));
    }

	public function create(Topic $topic)
	{
		$categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	/**
	 * 因为要使用到 Auth 类，所以需在文件顶部进行加载；
	 * store() 方法的第二个参数，会创建一个空白的 $topic 实例；
	 * $request->all() 获取所有用户的请求数据数组，如 ['title' => '标题', 'body' => '内容', ... ]；
	 * $topic->fill($request->all()); fill 方法会将传参的键值数组填充到模型的属性中，如以上数组，$topic->title 的值为 标题；
	 * Auth::id() 获取到的是当前登录的 ID；
	 * $topic->save() 保存到数据库中。
	 *
	 * @param TopicRequest $request 自定义验证规则
	 * @param Topic $topic
	 * @return void
	 */
	public function store(TopicRequest $request, Topic $topic)
	{
		$topic->fill($request->all());
		$topic->user_id = Auth::id();
		$topic->save();
		return redirect()->to($topic->link())->with('success', '成功创建话题！');
	}

	public function edit(Topic $topic)
	{
		$this->authorize('update', $topic);
		$categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());
		// 如果文章是置顶文章，更新缓存
		updateTopCache($topic);
		return redirect()->to($topic->link())->with('success', '话题更新成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		// 如果文章是置顶文章，删除缓存
		if(Redis::exists('topic_'.$topic->category->id.'_'.$topic->id)){
			Redis::del('topic_'.$topic->category->id.'_'.$topic->id);
		}
		$topic->delete();
		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}

	/**
	 * 上传图片
	 *
	 * @param Request $request
	 * @param ImageUploadHandler $uploader
	 * @return void
	 */
	public function uploadImage(Request $request, ImageUploadHandler $uploader)
	{
		//初始化数据,默认是失败的
		$data = [
			'success' => false,
			'msg' => '上传失败',
			'file_path' => ''
		];
		// 判断是否有文件上传，并赋值给$file
		if($file = $request->upload_file){
			// 保存图片到本地
			$result = $uploader->save($request->upload_file,'topics',\Auth::id(),1024);
			//图片保存成功的话
			if($result){
				$data['file_path'] = $result['path'];
				$data['msg'] = '上传成功';
				$data['success'] = true;
			}
		}
		return $data;
	}
	/**
	 * 将文章设为精华
	 * 如果已经设置就取消，如果没有设置就加精华
	 * ajax方法{id:topic_id}
	 * @return void
	 */
	public function excellent(Request $request)
	{
		$data = ['result' => false,'status' => false,'msg' => '参数不正确，失败!'];
		if($request->id){
			$topic = Topic::find($request->id);
			// 设置精华时禁止更新updated_at字段
			$this->authorize('manage', $topic);
			$topic->timestamps = false;
			if($topic->excellent){
				$topic->excellent = false;
				$topic->save();
				$data['result'] = true;
				$data['status'] = false;
				$data['msg'] = '取消设置精华成功!';
			}else{
				$topic->excellent = true;
				$topic->excellent_time = date("Y-m-d h:i:s",time());
				$topic->excellent_user = Auth::User()->nickname;
				$topic->save();
				$data['result'] = true;
				$data['status'] = true;
				$data['msg'] = '设置精华成功!';
			}
			$topic->timestamps = true;
			// 如果文章是置顶文章，更新缓存
			updateTopCache($topic);
		}
		return $data;
	}
	/**
	 * 将文章设置置顶
	 * ajax方法
	 * {id:topic_id}
	 * @param Request $request
	 * @return void
	 */
	public function topping(Request $request)
	{
		$data = ['result' => false,'status' => false,'top_expired' => '','msg' => '设置置顶失败!'];
		$topic = Topic::find($request->id);
		if($request->id){
			$this->authorize('manage', $topic);
			if(Redis::exists('topic_'.$topic->category->id.'_'.$topic->id)){
				Redis::del('topic_'.$topic->category->id.'_'.$topic->id);
				$data['result'] = true;
				$data['status'] = false;
				$data['msg'] = '取消置顶成功!';
			}else{
				if($request->expired){
					$expired = strtotime($request->expired);
					$now = time();
					if(($expired - $now) > 0){
						$result = Redis::setex('topic_'.$topic->category->id.'_'.$topic->id, ($expired - $now), serialize($topic));
						$data['result'] = true;
						$data['status'] = true;
						$data['msg'] = '设置置顶成功!';
					}else{
						$data['result'] = true;
						$data['status'] = false;
						$data['msg'] = '置顶有效期不能小于当前时间!';
					}
				}else{
					$result = Redis::set('topic_'.$topic->category->id.'_'.$topic->id, serialize($topic));
					$data['result'] = true;
					$data['status'] = true;
					$data['msg'] = '设置置顶成功!';
				}
			}
		}
		return $data;
	}
	/**	用户举报违规内容 */
	public function report(Request $request, User $user){
		$report = $request->all();
		// 获得拥有处理举报权限的用户
		$users =  User::permission("manage_report")->get();
		foreach ($users as $key => $user) {
			//通知管理员处理举报
			$user->notify(new ReportNotice($report));
		}
		$res = ['code'=>0,'msg'=>'举报成功！我们将核实违规内容后进行处理。'];
		return $res;
	}
}