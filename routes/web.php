<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::get('logout','Auth\LoginController@logout');

Route::get('customers', function() {

    return \File::files(realpath(app_path('../../httpdocs/uploads/home')));

    return \App\Customer::all();
});

Route::resources([
    'rooms' => 'RoomController',
    'admin-users' => 'AdminUserController',
    'admin-menu' => 'AdminMenuController',
    'invoices' => 'InvoiceController',
    'locales' => 'LocaleController',
    'prenotations' => 'PrenotationController',
    'pages' => 'PageController',
    'pagesc' => 'PageCController',
]);

Route::get('options', 'OptionController@index')->name('options.index');
Route::post('options', 'OptionController@save')->name('options.save');
Route::get('opzioni', 'OptionController@index')->name('options.index');

//TODO:: Rimuovere dopo,
Route::resources([
    'camere' => 'RoomController',
    'fatture' => 'InvoiceController',
    'prenotazioni' => 'PrenotationController',
    'pagine' => 'PageController',
    'paginec' => 'PageCController',
]);


Route::get('prenotations/get-customer/{id}', 'PrenotationController@getCustomerData')->name('prenotations.customer-data');
Route::get('prenotations/conferma-disp/{id}', 'PrenotationController@getInviaConfermaDisp')->name('prenotations.conferma-disp');
Route::get('invoices/get-prenotation/{id}', 'InvoiceController@getPrenotationData')->name('invoices.prenotation-data');

Route::post('pages/upload','PageController@upload')->name('pages.upload');
Route::post('pages/{page}/images/destroy/{id}', 'PageController@removeImage')->name('pages.images.remove');
Route::post('pages/{page}/images/move/{id}', 'PageController@moveImage')->name('pages.images.move');

Route::post('rooms/upload','RoomController@upload')->name('rooms.upload');

Route::get('fotohome','HomeFotoController@index')->name('fotohome');
Route::post('fotohome/upload','HomeFotoController@upload')->name('fotohome.upload');
Route::post('fotohome','HomeFotoController@save')->name('fotohome.save');

Route::get('/', 'HomeController@index');

Route::get('prova', function() {



});
