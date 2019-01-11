<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Requests;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/topics';
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
        $this->request = $request;
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        if($this->request->input('email')){
            return 'email';
        }
        if($this->request->input('phone')){
            return 'phone';
        }
    }

    public function showLoginForm()
    {
        // 社区首页banner图
		$loginbanners = Cache::rememberForever('login_banner', function (){
			return \DB::table('settings')->where('key','login_banner')->orderBy('updated_at','desc')->get();
		});
        return view('auth.login',compact('loginbanners'));
    }

    /**
     * 增加activated字段验证用户是否禁用
     *
     * @param Request $request
     * @return void
     */
    protected function credentials(Request $request)
    {
        return array_prepend($request->only($this->username(), 'password'),1,'activated');
    }
    
     
}
