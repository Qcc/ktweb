<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Session\Store as Session;
use Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    /**
     * @var Session
     */
    protected $session;
     /**
      * 短信验证码长度
      *
      * @var [type]
      */
    protected $length;

    public function __construct(Session $session, $length = 5)
    {
        $this->middleware('guest');
        $this->session = $session;
        $this->length = $length;
    }
    

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email','captcha' => 'required|captcha']);
    }

    /**
     * 发送手机短信找回密码
     *
     * @param Request $request
     * @return void
     */
    public function sendResetCodePhone(Request $request)
    {
        $rules = ['captcha' => 'bail|required|captcha','phone'=>'required|exists:users,phone'];
        $messages = [
            'captcha.required' => '验证码不能为空。',
            'captcha.captcha' => '验证码不正确。',
            'phone.required' => '手机号不能为空',
            'phone.exists' => '手机号不存在',
        ];
        $validator = Validator::make($request->input(), $rules,$messages);
        $res = ['success'=>false,'msg'=>'验证码不正确'];
        if (!$validator->fails()){
            $res = ['success'=>true,'msg'=>'短信已发送!'];   
            //发送短信
            $res['sms'] = $this->generate($request->phone);
        }else{
            $res = $validator->errors()->all();
        }
        return $res;

    }
    /**
     * 验证手机短信找回密码
     *
     * @param Request $request
     * @return void
     */
    public function resetByPhone(Request $request, User $user)
    {
        $res = ['success' => false, 'msg'=>'验证码不正确，请重新输入！'];
        if($this->check($request->code)){
            $phone = $this->session->get('smscode.phone');
            $user = User::where('phone',$phone)->first();
            if($user){
                $user->password = Hash::make($request->password);
                $user->setRememberToken(Str::random(60));
                $user->save();         
                $res = ['success' => true, 'msg'=>'密码已经修改，请使用新密码重新登录！'];  
                $this->session->remove('smscode'); 
            }else{
                $res = ['success' => false, 'msg'=>'手机号不正确！'];   
            }
        }
        return $res;
    }

    /**
     * 校验收到的值与会话中存储的是否一致
     *
     * @param [type] $value
     * @return void
     */
    protected function check($value){
        if ( ! $this->session->has('smscode'))
		{
			return false;
		}
		$key = $this->session->get('smscode.value');
		return $key === $value;
    }
    /**
     * 生成一个随机5位数的短信验证码
     * 调用阿里云服务发送短信
     * 并存储到sessions中
     *
     * @return void
     */
    protected function generate($phone){
        if($phone === null){
            return [];
        }
        $bag = mt_rand(10000,99999);
        $timestamp = time();
        //todo: 这里添加阿里云发送短信服务api
        $this->session->put('smscode', [
            'timestamp' => $timestamp,
            'value' => $bag,
            'phone' => $phone
        ]);

        return [
        	'value'     => $bag,
            'timestamp' => $timestamp,
            'phone' => $phone
        ];
    }
}
