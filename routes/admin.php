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

Route::resources([
    'rooms' => 'RoomController',
    'admin-users' => 'AdminUserController',
    'admin-menu' => 'AdminMenuController',
    'clienti' => 'CustomerController',
    'customers' => 'CustomerController',
    'invoices' => 'InvoiceController',
    'locales' => 'LocaleController',
    'prenotations' => 'PrenotationController',
    'pages' => 'PageController',
    'pagesc' => 'PageCController',
    'paragraphs' => 'PageParagraphController',
    'menu' => 'MenuController',
    'menuv' => 'MenuVController',
    'guests' => 'GuestController'
]);

Route::get('options', 'OptionController@index')->name('options.index');
Route::post('options', 'OptionController@save')->name('options.save');
Route::get('opzioni', 'OptionController@index')->name('options.index');

Route::get('locales/{locale}/translation','LocaleController@translation')->name('locales.translation');
Route::post('locales/{locale}/translation','LocaleController@saveTranslation');

Route::post('homebanner/generate/{locale}', 'HomeBannerController@generate')->name('homebanner.generate');
Route::post('homebanner/upload', 'HomeBannerController@upload')->name('homebanner.upload');

//TODO:: Rimuovere dopo,
Route::resources([
    'camere' => 'RoomController',
    'fatture' => 'InvoiceController',
    'prenotazioni' => 'PrenotationController',
    'pagine' => 'PageController',
    'ospiti' => 'GuestController',
    'homebanner' => 'HomeBannerController',
    'paginec' => 'PageCController',
]);

Route::get('invoices/{invoice}/print','InvoiceController@getPrint')->name('invoices.print');

Route::post('menu/move/{menu}', 'MenuController@move')->name('menu.move');

Route::post('paragraphs/move/{id}', 'PageParagraphController@move')->name('paragraphs.move');
Route::post('paragraphs/upload', 'PageParagraphController@upload')->name('paragraphs.upload');

Route::get('prenotations/get-customer/{id}', 'PrenotationController@getCustomerData')->name('prenotations.customer-data');
Route::get('prenotations/{id}/conferma-disp', 'PrenotationController@getInviaConfermaDisp')->name('prenotations.conferma-disp');
Route::get('prenotations/{id}/conferma-prenotazione', 'PrenotationController@getInviaConfermaPrenotazione')->name('prenotations.conferma-prenotazione');
Route::post('prenotations/{prenotation}/conferma', 'PrenotationController@postInviaConferma')->name('prenotations.invia-conferma');
Route::get('invoices/get-prenotation/{id}', 'InvoiceController@getPrenotationData')->name('invoices.prenotation-data');

Route::post('pages/upload','PageController@upload')->name('pages.upload');
Route::post('pages/{page}/images/destroy/{id}', 'PageController@removeImage')->name('pages.images.remove');
Route::post('pages/{page}/images/move/{id}', 'PageController@moveImage')->name('pages.images.move');

Route::post('rooms/upload','RoomController@upload')->name('rooms.upload');

Route::get('fotohome','HomeFotoController@index')->name('fotohome');
Route::post('fotohome/upload','HomeFotoController@upload')->name('fotohome.upload');
Route::post('fotohome','HomeFotoController@save')->name('fotohome.save');
Route::post('fotohome/generate/{locale}', 'HomeFotoController@generate')->name('fotohome.generate');

Route::get('/', 'HomeController@admin')->name('adminhome');

