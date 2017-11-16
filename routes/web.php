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
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

});
