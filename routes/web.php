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

Route::get('/', 'HomeController@index');
Route::get('camere', function() {

    $rooms = \App\Room::orderBy('Titolo')->limit(6)->get();
    return view('rooms', compact('rooms'));

})->name('rooms');

Route::get('camere/{room}/{slug}', function(App\Room $room, $slug){


    return view('room', compact('room'));

})->name('room');


Route::get('prenotazioni', function(){})->name('prenotations');



Route::get('offerte', function(){})->name('offers');


Route::get('prenotazioni', function(){

    return view('prenotations');

})->name('prenotations');

Route::get('contatti', function(){

    return view('contact');

})->name('contact');

Route::get('{slug}', function($slug) {

    $locale = app()->getLocale();
    $page = \App\Page::whereLang($locale)->whereSlug($slug)->first();
    if($page)
        return view('page', compact('page'));

    $page = \App\PageC::whereLang($locale)->whereSlug($slug)->first();
    if($page)
        return view('pagec', compact('page'));

    return abort(404);

})->name('page');