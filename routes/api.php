<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:sanctum'], function () {
});

Route::get('post/all', [App\Http\Controllers\Api\PostController::class, 'all']);

Route::resource('category', App\Http\Controllers\Api\CategoryController::class)->except(["create", "edit"]);
Route::resource('post', App\Http\Controllers\Api\PostController::class)->except(["create", "edit"]);
