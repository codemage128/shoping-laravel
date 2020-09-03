<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api') -> group(function(){
    Route::post('/products_app', 'Api\ProductController@productApp')->name("product_app.list");
    Route::post('/products', 'Api\ProductController@productList')->name("product.list");
    Route::post('/product/{id}', 'Api\ProductController@productInfo')->name("product.info");
    Route::post('/buyproduct/{id}', 'Api\ProductController@buyproduct')->name('buyproduct');
    Route::post('/pay/{id}', 'Api\ProductController@pay')->name('pay');
    Route::post('/payconfirm/{id}', "Api\ProductController@payconfirm")->name('payconfirm');
    Route::post('/aboutus', 'Api\ProductController@aboutus')->name('aboutus');
    Route::post('/setting', 'Api\ProductController@get_setting')->name('setting');
});
