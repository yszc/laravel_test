<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $message = '未找到该记录';
            $code = 404;
        } else {
            $message = $exception->getMessage();
            $code = $exception->getCode() ?: 500;
        }

        $res = [
            'code' => $code,
            'message' => $message,
            'data' => null,
        ];
        if (env('APP_DEBUG')) {
            $res['trace'] = $exception->getTrace();
        }
        return response()->json($res, $code);
    }
}
