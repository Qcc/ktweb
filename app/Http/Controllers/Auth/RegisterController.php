<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Session\Store as Session;
use Illuminate\Foundation\Auth\RegistersUsers;
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
            'vercode' => 'required|max:5|min:5',
            'password' => 'required|max:25|min:6',
            'captcha' => 'required|captcha',
        ], [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
            'password.requires' => '密码不能为空',
            'password.max' => '密码不能超过25位',
            'password.min' => '密码最少需要6位',
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

        return User::create([
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'avatar' => '/images/avatar.png',
        ]);
        
    }
}
