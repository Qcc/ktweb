<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productcol;
use App\Http\Requests\ProductRequest;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product, Request $request)
    {
		// 分页获取21条记录。默认获取15条
		$products = $product->withOrder($request->order)->paginate(21);

		return view('pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
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
        $product->fill($request->all());
		$product->user_id = Auth::id();
		$product->save();
		return redirect()->to($product->link())->with('success', '成功创建话题！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($product->slug) && $product->slug != $request->slug) {
            return redirect($product->link(), 301);
        }
        return view('pages.product.show', compact('product'));
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
}
