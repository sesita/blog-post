<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// ავტორიზაციის გვერდები
Route::group(['middleware' => 'api', 'prefix' => 'Auth'], function ($router) {
    Route::post('Login', [AuthController::class, 'login']);
    Route::post('Register', [AuthController::class, 'register']);
    Route::post('Logout', [AuthController::class, 'logout']);
    Route::post('Me', [AuthController::class, 'me']);
});

Route::middleware('permission')->group(function () {
    Route::resource('posts', PostsController::class);
    Route::resource('posts.comments', CommentsController::class)->except(['show', 'update'])->middleware('auth:api');
});