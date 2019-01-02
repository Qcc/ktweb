<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customercol;
use App\Models\Productcol;
use App\Models\Solutioncol;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\Solution;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer, Request $request)
    {
        // 获取带有banner的推荐案例
        $greatcustomers = Cache::rememberForever('greatcustomers', function (){
			return Customer::whereNotNull('banner')->orderBy('updated_at','desc')->paginate(6);
        });
		// 分页获取21条记录。默认获取15条
        $customers = $customer->withOrder($request->order,$request->particular)->orderby('updated_at','desc')->paginate(16);
        if($request->order == 'industry'){
            $columns = Solutioncol::all();
        } else if($request->order == 'profession'){
            $columns = Customercol::all();
        }else{
            $columns = Productcol::all();
        }
        $order=['order'=>$request->order];
		return view('pages.customer.index', compact('customers','order','columns','greatcustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        $this->authorize('create',$customer);
        $customercol = Customercol::all();
		$solutioncol = Solutioncol::all();
		$productcol = Productcol::all();
		return view('pages.customer.create_and_edit', compact('customer', 'customercol','productcol','solutioncol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('create',$customer);
        $customer->fill($request->all());
		$customer->user_id = Auth::id();
		$customer->save();
		return redirect()->to($customer->link())->with('success', '成功创建话题！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Customer $customer)
    {
        $advertisings = Cache::rememberForever('side_advertising', function (){
			return \DB::table('settings')->where('key','side_advertising')->get();
        });
        
        $sulotions = Solution::where('productcol_id',$customer->productcol_id)->paginate(5);
        $products = Product::where('productcol_id',$customer->productcol_id)->paginate(5);
        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($customer->slug) && $customer->slug != $request->slug) {
            return redirect($customer->link(), 301);
        }
        return view('pages.customer.show', compact('customer','advertisings','sulotions','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $this->authorize('update', $customer);
		$customercol = Customercol::all();
		$solutioncol = Solutioncol::all();
        $productcol = Productcol::all();
        // 清除案例推荐缓存
        Cache::forget('greatcustomers');
		return view('pages.customer.create_and_edit', compact('customer','customercol','productcol','solutioncol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);
		$customer->update($request->all());

		return redirect()->to($customer->link())->with('success', '案例更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('destroy', $customer);
		$customer->delete();

		return redirect()->route('customer.index')->with('message', '删除成功.');
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
			$result = $uploader->save($request->upload_file,'customer',\Auth::id(),1920);
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