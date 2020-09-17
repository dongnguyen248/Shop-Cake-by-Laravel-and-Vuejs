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

Route::resource('user', 'App\Http\Controllers\API\UserController');
Route::resource('product', 'App\Http\ControllersAPI\ProductController');
Route::resource('Category', 'App\Http\ControllersAPI\CategoryController');
Route::resource('productType', 'App\Http\ControllersAPI\ProductTypeController');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });