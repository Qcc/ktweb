<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productcol;

class ProductcolController extends Controller
{
    public function show(Product $product, Request $request, Productcol $productcol)
    {
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $products = $product->withOrder($request->order)
                        ->where('productcol_id',$productcol->id)
                        ->paginate(21);
        // 传参变量话题和分类 到模版中
        return view('pages.product.index',compact('products','productcol'));
    }
}
