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
    Route::get('/update_user_profile/{user}', 'UsersController@manageUserProfile');
    Route::post('/update_user_profile/edit/{user}', 'UsersController@saveUpdatedUserProfile');

    Route::get('/list_users','UsersController@index');
    Route::get('users/datatable','UsersController@getUsers')->name('get_users');
    Route::get('create_user','UsersController@CreateUser');
    Route::post('save_user','UsersController@SaveUser');
    Route::get('/edit_user/{user}','UsersController@EditUser');
    Route::get('/delete_user/{user}','UsersController@DeleteUser');
    Route::get('/view_user/{user}','UsersController@ViewUser');

    Route::get('/get_establishments','EstablishmentController@index');
    Route::get('/get_establishments_datatable','EstablishmentController@getEstablishments')->name('establishments.get_establishments');
    Route::get('/create_establishment','EstablishmentController@AddEstablishment');
    Route::post('/save_establishment','EstablishmentController@SaveEstablishment');
    Route::get('/edit_establishment/{establishment}','EstablishmentController@EditEstablishment');
    Route::post('/update_establishment/{establishment}', 'EstablishmentController@updateEstablishment');
    Route::get('/delete_establishment/{establishment}','EstablishmentController@DeleteEstablishment');
    Route::get('/view_establishment/{establishment}','EstablishmentController@ViewEstablishment');

    Route::get('get_establishments_accounts', 'EstablishmentController@getEstablishmentAccountIndex');
    Route::get('get_establishments_accounts_list', 'EstablishmentController@getEstablishmentsAccounts')->name('establishments.get_establishments_accounts');
    Route::get('get_establishments_types', 'EstablishmentController@getEstablishmentTypeIndex');
    Route::get('get_establishments_types_list', 'EstablishmentController@getEstablishmentsTypes')->name('establishments.get_establishments_types');
    Route::get('/get_menus','MenusController@getMenusIndex');
    Route::get('/get_menus_list','MenusController@getMenus')->name('menus.get_menus_list');
    Route::get('/get_establishment_details/{establishment}', 'EstablishmentController@getEstablishmentByID');

    Route::get('/get_promotions','PromotionsController@getPromotionsIndex');
    Route::get('/get_establishment_promotions', 'PromotionsController@getEstablishmentPromotionsIndex');
    Route::get('/get_establishment_promotions', 'PromotionsController@getEstablishmentPromotionsIndex');
    Route::get('/get_promotions_list','PromotionsController@getPromotions')->name('promotions.get_promotions');
    Route::get('/get_promotions_list_promo_theirs', 'PromotionsController@getEstablishmentPromotions')->name('promotions.get_establishment_promotions_promo_theirs');
    //Events

    Route::get('/get_events_list', 'EventsController@getEstablishmentEvents')->name('events.get_establishment_events');
    Route::get('get_establishment_events', 'EventsController@getEstEvents');
    Route::get('delete_establishment_event/{event}', 'Events@deleteEstablishmentEvent');
//    Route::get('/get_promotions_list_promo','PromotionsController@getEstablishmentPromotions')->name('promotions.get_establishment_promotions_promo');
    Route::get('/create_promotion', 'PromotionsController@createPromotions');
    Route::get('/create_establishment_promotion', 'PromotionsController@createEstablishmentPromotions');
    Route::get('/create_establishment_event', 'EventsController@createEstablishmentEvent');
    Route::post('/save_promotion', 'PromotionsController@savePromotion');
    Route::post('/save_establishment_promotion', 'PromotionsController@saveEstablishmentPromotion');
    Route::post('/update_promotion/{promotion}', 'PromotionsController@updatePromotion');
    Route::post('/update_establishment_promotion/{promotion}', 'PromotionsController@updateEstablishmentPromotion');
    Route::get('/edit_promotion/{promotion}', 'PromotionsController@editPromotion');
    Route::get('/edit_establishment_promotion/{promotion}', 'PromotionsController@editEstablishmentPromotion');
    Route::get('/view_promotion/{promotion}', 'PromotionsController@viewPromotion');
    Route::get('/view_establishment_promotion/{promotion}', 'PromotionsController@viewEstablishmentPromotion');
    Route::get('/delete_promotion/{promotion}', 'PromotionsController@deletePromotion');
    Route::get('/delete_establishment_promotion/{promotion}', 'PromotionsController@deleteEstablishmentPromotion');

    Route::get('/get_beers', 'BeersController@index');
    Route::get('/view_beer/{beer}', 'BeersController@show');
    Route::get('/edit_beer/{beer}', 'BeersController@edit');
    Route::get('/delete_beer/{beer}', 'BeersController@destroy');
    Route::post('/save_beer', 'BeersController@store');
    Route::post('/update_beer/{beer}', 'BeersController@update');
    Route::get('/create_beer', 'BeersController@create');
    Route::get('/get_beers_datatable', 'BeersController@getBeers')->name('beers.get_beers_list');

    Route::get('/get_beer_lovers','BeerLoversController@getBeerLoversIndex');
    Route::get('/get_beer_lovers_list','BeerLoversController@getBeerLovers')->name('users.get_beer_lovers');

    Route::get('/edit_establishment_event/{event}', 'EventsController@editEstablishmentEvent');
    Route::get('/view_establishment_events/{event}', 'EventsController@viewEstablishmentEvent');
    Route::get('delete_establishment_event', 'EventsController@deleteEstablishmentEvent');
    Route::post('save_establishment_event', 'EventsController@saveEstablishmentEvent');
    Route::post('update_establishment_event/{event}', 'EventsController@updateEstablishmentEvent');

    Route::get('/get_roles', 'RolesController@getRoles')->name('roles.get_roles');
    Route::get('create_role', 'RolesController@createRole');
    Route::post('/save_role', 'RolesController@saveRole');
    Route::get('view_role/{role}', 'RolesController@viewRole');
    Route::get('edit_role/{role}', 'RolesController@editRole');
    Route::get('delete_role/{role}', 'RolesController@deleteRole');
    Route::get('roles', 'RolesController@index');
    Route::post('/update_role/{role}', 'RolesController@updateRole');

    Route::get('/get_permissions', 'PermissionsController@getPermissions')->name('permissions.get_permissions');
    Route::get('create_permission', 'PermissionsController@createPermission');
    Route::post('/save_permission', 'PermissionsController@savePermission');
    Route::get('view_permission/{permission}', 'PermissionsController@viewPermission');
    Route::get('edit_permission/{permission}', 'PermissionsController@editPermission');
    Route::get('delete_permission/{permission}', 'PermissionsController@deletePermission');
    Route::get('permissions', 'PermissionsController@index');
    Route::post('update_permission/{permission}', 'PermissionsController@updatePermission');
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

});
