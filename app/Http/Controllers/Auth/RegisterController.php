<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Session\Store as Session;
use Illuminate\Foundation\Auth\RegistersUsers;
use Overtrue\EasySms\EasySms;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

use Hash;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/topics';
    protected $session;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Session $session)
    {
        $this->middleware('guest');
        $this->session = $session;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    { 
        return Validator::make($data, [
            'phone' => 'required|max:11|min:11|unique:users,phone',
            'vercode' => 'required|max:5|min:5|smscode',
            'password' => 'required|max:25|min:6',
            'captcha' => 'required|captcha',
        ], [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
            'password.requires' => '密码不能为空',
            'password.max' => '密码不能超过25位',
            'password.min' => '密码最少需要6位',
            'vercode.required' => '验证码不能为空',
            'vercode.smscode' => '验证码不正确',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // 注册成功后删除会话中的验证码，修改captcha包中ajax多次请求验证失败的问题
        $this->session->remove('captcha');
        $this->session->remove('smscode');
        // 提供13张默认头像
        $avatars = [
            'avatar001.png',
            'avatar002.png',
            'avatar003.png',
            'avatar004.png',
            'avatar005.png',
            'avatar006.png',
            'avatar007.png',
            'avatar008.png',
            'avatar009.png',
            'avatar010.png',
            'avatar011.png',
            'avatar012.png',
            'avatar013.png',
        ];
        $avatar = array_rand($avatars);
        return User::create([
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'avatar' => '/images/avatar/'.$avatars[$avatar],
        ]);
        
    }

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
        $validator = Validator::make($request->all(),$rules);
        $status = ['captcha'=>false,'msg'=>'验证码不正确'];
        if (!$validator->fails()){
            $status = ['captcha'=>true,'msg'=>'验证码正确'];
            $count = User::where('phone',$request->phone)->count();
            if($count != 0){
                $status['user']= true;
            }
        }
        return response()->json($status);
    }
    /**
     * 阿里云短信验证服务
     *
     * @param Request $request
     * @return void
     */
    public function smscode(Request $request){ 
        if ( ! $this->session->has('smscode')){
		    	return ['smscode'=>false,'msg'=>'短信验证码不正确','value'=>''];
		}
		$key = $this->session->get('smscode.value');
        if($key === $request->input('smscode')){
            return ['smscode'=>true,'msg'=>'短信验证码正确','value'=>$request->input('smscode')];
        }else{
            return ['smscode'=>false,'msg'=>'短信验证码不正确','value'=>''];
        }
    }
    /**
     * 需要图片验证码校验 校验成功后发送短信到手机
     *
     * @param Request $request
     * @return void
     */
    public function sendsms(Request $request, EasySms $easySms){
        $rules = [
            'captcha' => 'required|captcha',
            'phone' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        $status = ['sendsms'=>false,'msg'=>'短信未发送'];
        $timestamp = time();
        $phone = $request->phone;  
        Log::info("注册短信发送手机号".$phone);
        log::info($validator->errors());
        if (!$validator->fails()){
            // 生成5位随机数，左侧补0
            $code = str_pad(random_int(1, 99999), 5, 0, STR_PAD_LEFT);
            $config = config('easysms');
            $easySms = new EasySms($config);
            try {
                $result = $easySms->send($phone, [
                    'template' => 'SMS_1057',
                    'data' => [
                        'code' => $code
                    ],
                ]);
                Log::info("注册短信发送状态");
                Log::info($result);
                $this->session->put('smscode', [
                    'timestamp' => $timestamp,
                    'value' => $code,
                    'phone' => $phone
                ]);
            } catch (Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $response = $exception->getExceptions();
                return response()->json($response);
            }
        }
        return [
            'timestamp' => $timestamp,
            'phone' => $phone
        ];
    }
}
