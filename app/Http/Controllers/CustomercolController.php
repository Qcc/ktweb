<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Customercol;

class CustomercolController extends Controller
{
    public function show(Customer $customer, Request $request, Customercol $customercol)
    {
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $customers = $customer->withOrder($request->order)
                        ->where('customercol_id',$customercol->id)
                        ->paginate(21);
        // 传参变量话题和分类 到模版中
        return view('pages.customer.index',compact('customers','customercol'));
    }
}
