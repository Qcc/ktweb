<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store as Session;
use Illuminate\Http\Response;
use App\Models\User;
use Overtrue\EasySms\EasySms;

class CaptchaController extends Controller
{
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
        $this->session = $session;
        $this->length = $length;
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
        $validator = Validator::make($request->all(), $rules);
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
        if($this->check($request->input('smscode'))){
            $status = ['smscode'=>true,'msg'=>'短信验证码正确','value'=>$request->input('smscode')];
        }else{
            $status = ['smscode'=>false,'msg'=>'短信验证码不正确','value'=>''];
        }
        return response()->json($status);
    }
    /**
     * 需要图片验证码校验 校验成功后发送短信到手机
     *
     * @param Request $request
     * @return void
     */
    public function sendsms(Request $request){
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()){
            $v = $this->generate($request->input('phone'));
            $status = ['sendsms'=>true,'msg'=>'短信已发送','value'=>$v];
        }else{
            $status = ['sendsms'=>false,'msg'=>'短信未发送'];
        };
        return response()->json($status);
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
        $config = [
            // HTTP 请求的超时时间（秒）
            'timeout' => 5.0,
            // 默认发送配置
            'default' => [
                // 网关调用策略，默认：顺序调用
                'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
                // 默认可用的发送网关
                'gateways' => ['aliyun'],
            ],
            // 可用的网关配置
            'gateways' => [
                'errorlog' => [
                    'file' => '/tmp/easy-sms.log',
                ],
                'aliyun' => [
                    'access_key_id' => env('SMS_ACCESS_KEY_ID'),
                    'access_key_secret' => env('SMS_ACCESS_KEY_SECRET'),
                    'sign_name' => env('SMS_SIGN_NAME'),
                ],
            ],
        ];
        $easySms = new EasySms($config);

        $easySms->send($phone, [
            'content'  => '您的验证码为:'.$bag,
            'template' => 'SMS_001',
            'data' => [
                'code' => $bag
            ],
        ]);
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
}
