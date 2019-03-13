<?php

use Illuminate\Http\Request;
use App\restaurant;
use App\Http\Controllers\RestaurantController;

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

Route::get('restaurants','RestaurantController@index');

Route::get('restaurant/{restaurant}','RestaurantController@show');

Route::post('restaurant','RestaurantController@store');

Route::put('restaurant/{restaurant}','RestaurantController@update');

Route::delete('restaurant/{restaurant}','RestaurantController@delete');