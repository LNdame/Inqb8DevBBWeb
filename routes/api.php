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

Route::get('/get_est_promo_count/{id}','PromotionsController@getPromoCountApi');
Route::post('/add_est_event/','EventsController@saveEstablishmentEventApi');
Route::post('/update_est_event/{event}','EventsController@updateEstablishmentEventApi');
Route::get('/get_est_events/{id}', 'EventsController@getEstablishmentEventsApi');

Route::get('get_beer_lover/{firebase_id}', 'UsersController@GetBeerLover');
Route::get('get_beer_lovers', 'UsersController@GetBeerLovers');
Route::post('store_beer_lover/', 'UsersController@SaveBeerLoverApi');
Route::post('edit_beer_lover/{firebase_id}/', 'UsersController@EditBeerLoverApi');

Route::post('store_preference/', 'UsersController@storePreferences');
Route::post('edit_preferences/{firebase_id}/', 'UsersController@editPreferences');
Route::get('get_preferences/{firebase_id}', 'UsersController@getPreferences');

Route::post('store_discount/', 'UsersController@storeDiscount');
Route::get('get_discounts/{firebase_id}', 'UsersController@getDiscounts');

Route::get('get_users', 'UsersController@apiUsers');
Route::put('users/{user}', 'UsersController@update');
Route::delete('users/{user}', 'UsersController@delete');

Route::get('/get_establishments','EstablishmentController@getEstablishmentsApi');
Route::get('/get_establishment/{establishment}', 'EstablishmentController@getEstablishmentApi');

Route::get('/get_events', 'EventsController@getEventsApi');
Route::get('/get_event/{event}', 'EventsController@getEventApi');

Route::get('get_promotions', 'PromotionsController@apiPromotions');
Route::post('/save_promotion', 'PromotionsController@savePromotionApi');
Route::post('/update_promotion/{promotion}', 'PromotionsController@updateEstablishmentPromotionApi');
Route::get('/delete_promotion/{promotion}', 'PromotionsController@deleteEstablishmentPromotionApi');

Route::get('get_promotion/{id}', 'PromotionsController@apiPromotion');
Route::get('/get_referal_counter/{referal_code}', 'PromotionsController@getReferalCount');
Route::get('/get_discount_counter/{id}', 'PromotionsController@getDiscountsCounter');
Route::get('/get_beers', 'BeersController@apiBeers');
Route::get('/get_beer/{beer}', 'BeersController@apiBeer');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('establishment_login','LoginApiController@attemptLogin');
Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes

});
