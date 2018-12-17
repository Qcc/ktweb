<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Business;
use Auth;
/**
 * 伙伴申请 客户需求提交
 */
class BusinessController extends Controller
{
    public function __construct()
    {
		// 'except' => ['index', 'show'] —— 对除了 index() 和 show() 以外的方法使用 auth 中间件进行认证。
		// 使用其余方法需要登录
        $this->middleware('auth', ['except' => ['show', 'info','store']]);
    }
    public function show()
    {
        return view('pages.partner');
    }

    public function info()
    {
        return view('pages.partnerform');
    }

    public function store(Business $business, Request $request)
    {
        $rules = [
            'phone' => 'required|min:7|max:11',
            'name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        $data = [
            'status'=>false,
            'msg'=>'提交失败，电话号码不正确!'
        ];
        if (!$validator->fails()){
            $data = [
                'status'=>true,
                'msg'=>'提交成功!，工作日我们将在30分钟内联系您!'
            ];
            $business = Business::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'city' => $request->city,
            ]);
        }
        return $data;
    }

    /**
     * 确认商机已经联系 分配联系员工
     *
     * @param [type] $token
     * @return void
     */
    public function check($token)
    {
        $business = Business::where('active_token', $token)->firstOrFail();
        return view('pages.partnercheck',compact('business'));
    }

    public function update(Business $business, Request $request)
    {
        $validator = Validator::make($request->all(), ['coment' => 'required']);
        if (!$validator->fails()){

            $business->status = true;
            $business->user_id = Auth::User()->id;
            $business->coment = $request->coment;
            $business->save();
        }
        return redirect()->route('business.check',$business->active_token)->with('message', '提交结果成功！');
    }
}
