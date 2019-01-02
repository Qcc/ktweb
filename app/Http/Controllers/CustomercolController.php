<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Customercol;

class CustomercolController extends Controller
{
    // public function show(Customer $customer, Request $request, Customercol $customercol)
    // {
    //     // 读取分类 ID  关联的话题， 并按照每20条分页
    //     $customers = $customer->withOrder($request->order)
    //                     ->where('customercol_id',$customercol->id)
    //                     ->paginate(21);
    //     // 传参变量话题和分类 到模版中
    //     return view('pages.customer.index',compact('customers','customercol'));
    // }

    public function update(Request $request,Customercol $customercol)
    {
        $data = [
            'code'=>0,
            'msg'=>'类目更新成功!'
        ];
        $customercol = Customercol::find($request->id);
        $customercol->update($request->all());
        return $data;
    }

    public function store(Request $request, Customercol $customercol)
	{
        $data = [
            'code'=>0,
            'msg'=>'新建类目成功!'
        ];
		$customercol->fill($request->all());
		$customercol->save();
		return $data;
    }
    
    public function destroy(Request $request, Customercol $customercol)
	{
        $data = [
            'code'=>0,
            'msg'=>'删除类目成功!'
        ];
		$customercol = Customercol::find($request->id);
		$customercol->delete();
		return $data;
    }
}
