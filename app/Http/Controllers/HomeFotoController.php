<?php

namespace App\Http\Controllers;

use App\AdminMenu;
use App\HomeFoto;
use App\Room;
use Illuminate\Http\Request;

class HomeFotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $homefoto = HomeFoto::query();

        if($lang = request('lang', session('homefoto.lang','it'))) {

            request()->merge(['lang' => $lang]);
            \Session::put('homefoto.lang', $lang);

            $homefoto->whereLang($lang);

        }
        $homefoto = $homefoto->get();

        return view('homefoto', compact('homefoto'));
    }

    public function generate(\App\Locale $locale)
    {
        $homefoto = HomeFoto::whereLang('it')->get();
        foreach($homefoto as $hf) {
            $hf->id = null;
            $hf->exists = false;
            $hf->locale()->associate($locale);
            $hf->save();
        }

        return redirect()->route('fotohome');
    }


    public function upload(Request $request)
    {

        $id = $request->get('id');
        $file = $request->file('file');

        $homefoto = HomeFoto::find($id);

        if(!$homefoto)
            return ['errore' => 'Foto non valida'];

        if(!$file->isValid())
            return ['errore' => 'Foto non valida'];


        $url ='/'.$file->storePublicly('uploads/home', 'halex');

        $homefoto->update(['url' => $url]);
        return $homefoto;
    }

    public function save(Request $request)
    {
        $id = $request->get('id');

        $homefoto = HomeFoto::find($id);
        if($homefoto)
            $homefoto->update($request->all());

        return $homefoto;
    }
}
