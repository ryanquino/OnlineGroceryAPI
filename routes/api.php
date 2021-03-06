<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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
Route::get('/getAllBestSellers', 'App\Http\Controllers\ProductsController@getAllBestSellers');
Route::get('/getAllProducts', 'App\Http\Controllers\ProductsController@getAllProducts');
Route::get('/getAllCategories', 'App\Http\Controllers\CategoryController@getAllCategories');
Route::get('/getProfile', 'App\Http\Controllers\UserController@getProfile');

Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::post('/login', 'App\Http\Controllers\UserController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
