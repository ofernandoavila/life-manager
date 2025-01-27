<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiSecurity;
use Illuminate\Support\Facades\Route;

Route::get('/health', function() {
    return response([
        'app_status' => 'Running',
        'app_name' => 'Life Manager',
        'app_version' => '0.0.1'
    ]);
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('/users', [UserController::class, 'get_all']);
    Route::post('/users', [UserController::class, 'create_new_user']);
    Route::delete('/users', [UserController::class, 'delete_user']);
        
    
    Route::group(['prefix' => 'auth'], function() {
        Route::post('/login', [ AuthController::class, 'login' ]);
        Route::post('/create-account', [ AuthController::class, 'create_account' ]);
    });
    
    Route::group(['middleware' => 'api'], function() {
        Route::get("/me", [ AuthController::class, 'me']);
    });
})->middleware(ApiSecurity::class);

