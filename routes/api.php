<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

});

Route::get('fetch-name', function(){
    if(request()->has('q')){
        return \App\Utils\CustomHelper::fetchLocCoordinates(request()->get('q'));
    }
    return response()->json([]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Define routes within the middleware closure
Route::middleware('auth:api')->group(function () {
    // Define API resource routes for 'users'
    Route::apiResource('users', 'Api\V1\Admin\UsersApiController');

    Route::get('soft-deleted', [AuthController::class, 'softDeleteUsers']);

});