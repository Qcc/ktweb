<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Closure;
use Auth;
use App\Models\File;

class CheckDownload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 全局辅助函数 定义在ktweb\bootstrap\helpers.php
        $file_name = cut_str($request->path(),'.',0);
        $name = cut_str($file_name,'/',-1);
        $file = File::where('hash',$name)->first();
        if(!$file){
            return $next($request);
        }
        if($file->logined && !Auth::check()){
            return redirect('login');
        }
        return $next($request);
    }
}
