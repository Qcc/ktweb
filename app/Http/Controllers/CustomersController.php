<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customercol;
use Auth;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer, Request $request)
    {
		// 分页获取21条记录。默认获取15条
		$customers = $customer->withOrder($request->order)->paginate(21);

		return view('pages.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        $customercol = Customercol::all();
		return view('pages.customer.create_and_edit', compact('customer', 'customercol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, Customer $customer)
    {
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
        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($customer->slug) && $customer->slug != $request->slug) {
            return redirect($customer->link(), 301);
        }
        return view('pages.customer.show', compact('customer'));
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
		return view('pages.customer.create_and_edit', compact('customer','customercol'));
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

		return redirect()->to($customer->link())->with('success', '产品更新成功！');
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
}