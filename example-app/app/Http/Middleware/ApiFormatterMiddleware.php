<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiFormatterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
    
        $data = $response->original;
        $status = $response->status();
        
        if ($status >= 300 && $status < 600) {
            $message = $data['message'] ?? 'internal server error';
            $code = $data['code'] ?? $status;
            $data = null;
        } else {
            $message = 'ok';
            $code = 200;
        }
        
        $formattedResponse = [
            'code' => $code,
            'message' => $message,
            'data' => $data ?? null,
        ];
        
        if (env('APP_DEBUG') && $status >= 500 && $status < 600) {
            $formattedResponse['trace'] = $response->original['trace'] ?? null;
        }
        
        return response()->json($formattedResponse, $code);
    }
}
