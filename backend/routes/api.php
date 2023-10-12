<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Middleware\API\v1\ProtectedRouteAuth;


Route::get('/', function() {
    return response()->json(['api_name' => 'banckend-bsb', 'api_version' => 'v1.0.0']);
});

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware([ProtectedRouteAuth::class])->group(function () {
        Route::post('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('user', [UserController::class, 'create']);
    });
});

   
