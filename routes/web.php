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

Route::get('/', 'HomeController@index')->name('homepage');
Route::get('camere', function() {

    $rooms = \App\Room::orderBy('Titolo')->limit(6)->get();
    return view('rooms', compact('rooms'));

})->name('rooms');

Route::get('camere/{room}/{slug}', function(App\Room $room, $slug){


    return view('room', compact('room'));

})->name('room');


Route::get('prenotazioni', function(){})->name('prenotations');



Route::get('offerte/{idpromo?}', function($idpromo = null){

    $offers = promoVenereSPA($idpromo);

    if(!$idpromo) {
        return view('offers', compact('offers'));
    } else {
        $offer = $offers['promozioni'][0];
        return view('offer', compact('offer'));

    }

})->name('offers');


Route::get('prenotazioni', function(){

    return view('prenotations');

})->name('prenotations');

Route::post('prenotazioni', function() {

    $prenotation = new \App\Prenotation();
    $prenotation->DataArrivo = request('dataarrivo');
    $prenotation->DataPartenza = request('datapartenza');
    $prenotation->Email = request('email');
    $prenotation->Note = request('message');
    $prenotation->NrAdulti = request('nradulti');
    $prenotation->NrBambini = request('nrbambini');
    $prenotation->Nome = request('nome');
    $prenotation->Cognome = request('cognome');
    $prenotation->Telefono = request('phone','---');
    $prenotation->origine = PRENOT_ORIG_WEB;
    $prenotation->room()->associate(request('camera'));


    $prenotation->save();

    $staff = get_option('prenotazioni.destinatario', 'salvatorepruiti@hotmail.com');
    $body = get_option('prenotazioni.email.corpo.cliente');
    $bodyStaff = get_option('prenotazioni.email.corpo.staff');

    $bodyStaff = str_ireplace("[message]", $prenotation->Note, $bodyStaff);

    foreach($prenotation->getAttributes() as $field => $value) {

        $bodyStaff = str_ireplace("[$field]", $value, $bodyStaff);


    }

    \Mail::to($staff)->send(new \App\Mail\PrenotationStaffMailable($bodyStaff));

    return request()->all();


    /*
     *
     *   Mittente = Opzioni("email.mittente") : If Mittente = "" Then Mittente = "Halex.it <info@halex.it>"
        Staff = Opzioni("prenotazioni.destinatario")
        CorpoEmail = Opzioni("prenotazioni.email.corpo")
        CorpoEmailStaff = Opzioni("prenotazioni.email.corpo.staff")

        Destinatario = FormData("nome") & " <" & FormData("email") & ">"

        OggettoEmail = "Prenotazione su Halex.it"
        Corpo = (Compila(CorpoEmail, FormData))
        Formato = 0 'HTML
        Call Mail(Mittente, Destinatario, OggettoEmail, Corpo, Formato)

        OggettoEmail = "Prenotazione su Halex.it"
        Corpo = (Compila(CorpoEmailStaff, FormData))
        Formato = 0 'HTML
        Call Mail(Mittente, Staff, OggettoEmail, Corpo, Formato)
     *
     */



});

Route::get('contatti', function(){

    return view('contact');

})->name('contact');

Route::post('contatti', function() {

    \Mail::send(new \App\Mail\ContattiMailable());

    return request()->all();


});

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