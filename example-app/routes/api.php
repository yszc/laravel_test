<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiFormatterMiddleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware(ApiFormatterMiddleware::class)->group(function () {
    Route::get('/health_check', function (Request $request){
        return ['health' => 'ok'];
    });

    Route::get('/test_exception', function (Request $request){
        throw new Exception('test exception');
    });

    Route::get('/test_error', function (Request $request){
        $a = 1;
        $b = 0;
        $c = $a / $b;
    });

    Route::get('/test_log', function(Request $request){
        return Log::channel('database')->error('This is test');
    });

    Route::get('/test_db', function(Request $request){
        return  DB::select('show tables;');
    });

    Route::get('/test_get', [\App\Http\Controllers\ServiceController::class, 'get']);
    Route::post('/test_post', [\App\Http\Controllers\ServiceController::class, 'post']);
    Route::get('/check_brackets', [\App\Http\Controllers\ServiceController::class, 'checkBrackets']);
    
});