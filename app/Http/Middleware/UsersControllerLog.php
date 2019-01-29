<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class UsersControllerLog
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
        $now = now()->toDateTimeString();
        $data = $request->all();
        if(isset($data['password'])){
            $data['password'] = '***';
        }
        if(isset($data['password-confirm'])){
            $data['password-confirm'] = '***';
        }
        $log = [
            'url' => $request->path(),
            'method' => $request->getRealMethod(),
            'content' => json_encode($data),
            'created_at' => $now,
            'updated_at' => $now,
        ];
        Log::info($log);
        return $next($request);
    }
}
