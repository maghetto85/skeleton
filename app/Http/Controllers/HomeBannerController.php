<?php

namespace App\Http\Controllers;

use App\HomeBanner;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
    public function index()
    {
        $homebanner = HomeBanner::query();

        if($lang = request('lang', session('homebanner.lang','it'))) {

            request()->merge(['lang' => $lang]);
            \Session::put('homebanner.lang', $lang);

            $homebanner->whereLang($lang);

        }

        $homebanner = $homebanner->first();

        return view('homebanner')->with('homebanner', $homebanner);
    }

    public function generate(\App\Locale $locale)
    {
        $homebanner = HomeBanner::whereLang('it')->first();
        if($homebanner) {
            $homebanner->id = null;
            $homebanner->exists = false;
            $homebanner->locale()->associate($locale);
            $homebanner->save();
        }

        return redirect()->route('homebanner.index');
    }

    public function update(HomeBanner $homebanner)
    {
        $homebanner->update(request()->only('testo','link'));

        return $homebanner;
    }

    public function upload(Request $request)
    {

        $id = $request->get('id');
        $field = $request->get('field');
        $file = $request->file('file');

        $homebanner = HomeBanner::find($id);

        if(!$homebanner)
            return ['errore' => 'Banner non valido!'];

        if(!$file->isValid())
            return ['errore' => 'Foto non valida'];


        $fname = str_random(40).'.'.$file->getClientOriginalExtension();

        $url = '/'.$file->storePubliclyAs('uploads/homebanner', $fname, 'halex');

        $homebanner->update([$field => $url]);
        return ['url' => $url ];
    }

}
