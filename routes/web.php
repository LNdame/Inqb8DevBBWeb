<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/list_users','UsersController@index');
    Route::get('users/datatable','UsersController@getUsers')->name('get_users');

    Route::get('/get_establishments','EstablishmentController@index');
    Route::get('/get_establishments_datatable','EstablishmentController@getEstablishments')->name('establishments.get_establishments');
    Route::get('create_users','EstablishmentController@AddEstablishment');


    Route::get('/get_establishments_accounts','EstablishmentController@getEstablishmentAccountIndex');
    Route::get('/get_establishments_accounts_list','EstablishmentController@getEstablishmentsAccounts')->name('establishments.get_establishments_accounts');
    Route::get('/get_establishments_types','EstablishmentController@getEstablishmentTypeIndex');
    Route::get('/get_establishments_types_list','EstablishmentController@getEstablishmentsTypes')->name('establishments.get_establishments_types');
    Route::get('/get_menus','MenusController@getMenusIndex');
    Route::get('/get_menus_list','MenusController@getMenus')->name('menus.get_menus_list');

    Route::get('/get_promotions','PromotionsController@getPromotionsIndex');
    Route::get('/get_promotions_list','PromotionsController@getPromotions')->name('promotions.get_promotions');

    Route::get('/get_beer_lovers','BeerLoversController@getBeerLoversIndex');
    Route::get('/get_beer_lovers_list','BeerLoversController@getBeerLovers')->name('users.get_beer_lovers');
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

});
