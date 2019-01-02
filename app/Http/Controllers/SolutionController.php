<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solutioncol;
use App\Models\Solution;
use App\Http\Requests\SolutionRequest;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class SolutionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Solution $solution)
    {
        $this->authorize('create',$solution);
        $solutioncol = Solutioncol::all();
		return view('pages.solution.create_and_edit', compact('solution', 'solutioncol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolutionRequest $request, Solution $solution)
    {
        $this->authorize('create',$solution);
        $solution->fill($request->all());
		$solution->user_id = Auth::id();
		$solution->save();
		return redirect()->to($solution->link())->with('success', '成功创建话题！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Solution $solution)
    {
        $advertisings = Cache::rememberForever('side_advertising', function (){
			return \DB::table('settings')->where('key','side_advertising')->get();
        });
        $customers = Customer::where('productcol_id',$solution->productcol_id)->paginate(5);
        $products = Product::where('productcol_id',$solution->productcol_id)->paginate(5);
        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($solution->slug) && $solution->slug != $request->slug) {
            return redirect($solution->link(), 301);
        }
        return view('pages.solution.show', compact('solution','advertisings','customers','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Solution $solution)
    {
        $this->authorize('update', $solution);
		$solutioncol = Solutioncol::all();
		return view('pages.solution.create_and_edit', compact('solution','solutioncol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SolutionRequest $request, Solution $solution)
    {
        $this->authorize('update', $solution);
		$solution->update($request->all());

		return redirect()->to($solution->link())->with('success', '话题更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solution $solution)
    {
        $this->authorize('destroy', $solution);
		$solution->delete();

		return redirect()->route('solution.index')->with('message', '删除成功.');
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
			$result = $uploader->save($request->upload_file,'solution',\Auth::id(),1920);
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
