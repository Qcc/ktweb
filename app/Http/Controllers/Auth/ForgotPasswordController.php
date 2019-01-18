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
use Overtrue\EasySms\EasySms;

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
    protected $easySms;

    public function __construct(Session $session, EasySms $easySms)
    {
        $this->middleware('guest');
        $this->session = $session;
        $this->easySms = $easySms;
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
            $phone = $request->phone;  
            // 生成5位随机数，左侧补0
            $code = str_pad(random_int(1, 99999), 5, 0, STR_PAD_LEFT);
            try {
                $result = $this->easySms->send($phone, [
                    'template' => 'SMS_1057',
                    'data' => [
                        'code' => $code
                    ],
                ]);
            } catch (Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $response = $exception->getExceptions();
                return response()->json($response);
            }
            $timestamp = time();
            $this->session->put('smscode', [
                'timestamp' => $timestamp,
                'value' => $code,
                'phone' => $phone
            ]);
            $res = ['success'=>true,'msg'=>'短信已发送!','phone' => $phone,];   
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
        $code = $this->session->get('smscode.value');
        $phone = $this->session->get('smscode.phone');
        if($code == $request->code){
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

}
