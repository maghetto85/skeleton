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
}
