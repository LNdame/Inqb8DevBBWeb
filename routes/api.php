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
Route::get('get_beer_lover/{firebase_id}', 'UsersController@GetBeerLover');
Route::get('get_beer_lovers', 'UsersController@GetBeerLovers');
Route::post('store_beer_lover/', 'UsersController@SaveBeerLoverApi');
Route::post('edit_beer_lover/{firebase_id}/', 'UsersController@EditBeerLoverApi');
//Route::post('store_beer_lover/', 'UsersController@Save');

Route::get('get_users', 'UsersController@apiUsers');
Route::put('users/{user}', 'UsersController@update');
Route::delete('users/{user}', 'UsersController@delete');

Route::get('/get_establishments','EstablishmentController@getEstablishmentsApi');
Route::get('/get_establishment/{establishment}', 'EstablishmentController@getEstablishmentApi');

Route::get('get_promotions', 'PromotionsController@apiPromotions');
Route::get('get_promotion/{id}', 'PromotionsController@apiPromotion');

Route::get('get_beers', 'BeersController@apiBeers');
Route::get('get_beer/{beer}', 'BeersController@apiBeer');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes

});
