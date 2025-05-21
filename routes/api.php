<?php

use App\Http\Controllers\ApiLogController;
use App\Http\Controllers\ExternalApiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/users',[UserController::class,'index'])->name('users');
Route::get('/logs',[ApiLogController::class,'index'])->name('logs');
Route::get('/post',[ExternalApiController::class,'getPost'])->name('post');
Route::get('/posts/user/{id}',[ExternalApiController::class,'postByUserId'])->name('post.user');
Route::post('/logs',[ApiLogController::class,'store'])->name('logs.store');
Route::patch('/logs/{id}',[ApiLogController::class,'update'])->name('logs.update');
Route::delete('/logs/{id}',[ApiLogController::class,'destroy'])->name('logs.destroy');
Route::get('/posts/{id}',[ExternalApiController::class,'getPostById'])->name('posts_id');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
