<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Handlers\ImageUploadHandler;
use Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
		// 'except' => ['index', 'show'] —— 对除了 index() 和 show() 以外的方法使用 auth 中间件进行认证。
		// 使用其余方法需要登录
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	// $request->order 是获取 URI http://keweb.test/topics?order=recent 中的 order 参数
	public function index(Request $request, Topic $topic)
	{
		// 分页获取20条记录。默认获取15条
		$topics = $topic->withOrder($request->order)->paginate(20);
		return view('topics.index', compact('topics'));
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
		// 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }
        return view('topics.show', compact('topic'));
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

		return redirect()->to($topic->link())->with('success', '话题更新成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
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
}