<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productcol;
use App\Models\Solution;
use App\Models\Customer;
use App\Http\Requests\ProductRequest;
use Auth;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $this->authorize('create',$product);
        $productcol = Productcol::all();
		return view('pages.product.create_and_edit', compact('product', 'productcol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Product $product)
    {
        $this->authorize('create',$product);
        $product->fill($request->all());
		$product->user_id = Auth::id();
		$product->save();
		return redirect()->to($product->link())->with('success', '成功创建产品！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $advertisings = Cache::rememberForever('side_advertising', function (){
			return \DB::table('settings')->where('key','side_advertising')->get();
        });
        $sulotions = Solution::where('productcol_id',$product->productcol_id)->paginate(5);
        $customers = Customer::where('productcol_id',$product->productcol_id)->paginate(5);
        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($product->slug) && $product->slug != $request->slug) {
            return redirect($product->link(), 301);
        }
        return view('pages.product.show', compact('product','advertisings','sulotions','customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
		$productcol = Productcol::all();
		return view('pages.product.create_and_edit', compact('product','productcol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
		$product->update($request->all());

		return redirect()->to($product->link())->with('success', '产品更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('destroy', $product);
		$product->delete();

		return redirect()->route('product.index')->with('message', '删除成功.');
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
			$result = $uploader->save($request->upload_file,'product',\Auth::id(),1024);
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
