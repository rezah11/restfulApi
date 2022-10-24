<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix'=>'auth'],function (){
    Route::post('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('login');
    Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->middleware('auth:api')->name('logout');
    Route::get('/user',[\App\Http\Controllers\AuthController::class,'user'])->middleware('auth:api')->name('authUser');
});

Route::group(['prefix'=>'user','middleware'=>'auth:api'],function (){
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'user'])->name('user');
    Route::post('/', [\App\Http\Controllers\UserController::class, 'create'])->name('createUser');
    Route::put('/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('updateUser');
    Route::delete('/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('deleteUser');
});

Route::group(['prefix' => 'article','middleware'=>'auth:api'], function () {
    Route::get('/', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles');
    Route::get('/{id}', [\App\Http\Controllers\ArticleController::class, 'article'])->name('article');
    Route::post('/', [\App\Http\Controllers\ArticleController::class, 'create'])->name('createArticle');
    Route::put('/{id}', [\App\Http\Controllers\ArticleController::class, 'update'])->name('updateArticle');
    Route::delete('/{id}', [\App\Http\Controllers\ArticleController::class, 'delete'])->name('deleteArticle');
});
