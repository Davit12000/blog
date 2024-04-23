<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Tag\TagController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResources([
        'blogs' => BlogController::class,
        'tags' => TagController::class,
        'comments' => CommentController::class,
    ]);
});
   
Route::GET('/blogs/{blog}', [BlogController::class, 'show']);
Route::GET('/blogs', [BlogController::class, 'index']);
Route::GET('/comments', [CommentController::class, 'index']);
Route::GET('/comments/{comment}', [CommentController::class, 'index']);
   
