<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;

class CaptchaController extends Controller
{
    /**
     * ajax 验证输入验证码是否正确
     * 原包中存在ajax多次验证失败的问题
     * 需要注释掉captcha包中
     * ktweb\vendor\mews\captcha\src\Captcha.php; line:443
     * $this->session->remove('captcha');
     * @param Request $request
     * @return void
     */
    public function captcha(Request $request){
        
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make($request->all(), $rules);
        $status=[];
        if ($validator->fails())
        {
            $status = ['captcha'=>false,'msg'=>'验证码不正确'];
        }
        else
        {
            $status = ['captcha'=>true,'msg'=>'验证码正确'];
        }
        return response()->json($status);
    }
}
