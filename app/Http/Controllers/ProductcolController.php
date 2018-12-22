<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Solution;
use App\Models\Customer;
use App\Models\Productcol;
use App\Handlers\ImageUploadHandler;

class ProductcolController extends Controller
{
    public function show(Product $product,Solution $solution, Request $request,Customer $customer, Productcol $productcol)
    {
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $products = $product->withOrder($request->order)
                        ->where('productcol_id',$productcol->id)
                        ->paginate(8);
        //读取产品相关解决方案
        $solutions = $solution->withOrder($request->order)
                        ->where('productcol_id',$productcol->id)
                        ->paginate(8);
        //读取产品相关客户案例
        $customers = $customer->withOrder($request->order)
                        ->where('productcol_id',$productcol->id)
                        ->paginate(8);
        
        // 传参变量话题和分类 到模版中
        return view('pages.product.products',compact('products','solutions','customers','productcol'));
    }

    public function update(Request $request,Productcol $productcol)
    {
        $data = [
            'code'=>0,
            'msg'=>'类目更新成功!'
        ];
        $productcol = Productcol::find($request->id);
        $productcol->update($request->all());
        return $data;
    }

    public function store(Request $request, Productcol $productcol)
	{
        $data = [
            'code'=>0,
            'msg'=>'新建类目成功!'
        ];
		$productcol->fill($request->all());
		$productcol->save();
		return $data;
    }
    
    public function destroy(Request $request, Productcol $productcol)
	{
        $data = [
            'code'=>0,
            'msg'=>'删除类目成功!'
        ];
		$productcol = Productcol::find($request->id);
		$productcol->delete();
		return $data;
    }
    
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
	{
		//初始化数据,默认是失败的
		$data = [
			"code"=> 1
            ,"msg"=> "上传失败!"
            ,"data"=>[ 
              "src"=> ""
            ]
		];
		// 判断是否有文件上传，并赋值给$file
		if($file = $request->upload_file){
			// 保存图片到本地
			$result = $uploader->save($request->upload_file,'Categories',\Auth::id(),1920);
			//图片保存成功的话
			if($result){
				$data['code'] = 0;
				$data['data']['src'] = $result['path'];
				$data['msg'] = '上传成功!';
			}
		}
		return $data;
	}
}
