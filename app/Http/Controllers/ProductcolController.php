<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Solution;
use App\Models\Customer;
use App\Models\Productcol;

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
                        ->paginate(4);
        
        // 传参变量话题和分类 到模版中
        return view('pages.product.products',compact('products','solutions','customers','productcol'));
    }
}
