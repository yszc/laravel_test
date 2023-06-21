<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestLoggerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // 记录请求到数据库
        DB::table('request_logs')->insert([
            'request_id' => uniqid(),
            'request_method' => $request->method(),
            'request_path' => $request->path(),
            'request_data' => json_encode($request->all()),
            'response_content' => $response->getContent(),
            'time' => now(),
        ]);

        return $response;
    }
}
