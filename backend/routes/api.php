<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\ProfileController;
use App\Http\Controllers\API\v1\ClientController;
use App\Http\Controllers\API\v1\LoanRequestController;
use App\Http\Controllers\API\v1\SolicitationController;
use App\Http\Middleware\API\v1\ProtectedRouteAuth;


Route::get('/', function() {
    return response()->json(['api_name' => 'banckend-bsb', 'api_version' => 'v1.0.0']);
});

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('solicitation', [SolicitationController::class, 'index']);
    Route::middleware([ProtectedRouteAuth::class])->group(function () {
        Route::post('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('user', [UserController::class, 'create']);

        Route::post('profile', [ProfileController::class, 'create']);
        Route::get('profile', [ProfileController::class, 'getAll']);
        Route::put('profile/{id}', [ProfileController::class, 'update']);
        Route::get('profile/{id}', [ProfileController::class, 'getById']);
        Route::delete('profile/{id}', [ProfileController::class, 'delete']);

        // Route::post('client', [ClientController::class, 'create']);
        Route::get('client', [ClientController::class, 'getAll']);
        Route::put('client/{id}', [ClientController::class, 'update']);
        Route::get('client/{id}', [ClientController::class, 'getById']);
        Route::delete('client/{id}', [ClientController::class, 'delete']);

        Route::get('loanrequest', [LoanRequestController::class, 'getAll']);
        Route::put('loanrequest/{id}', [LoanRequestController::class, 'update']);
        Route::get('loanrequest/{id}', [LoanRequestController::class, 'getById']);
        Route::delete('loanrequest/{id}', [LoanRequestController::class, 'delete']);
    });
});

   
