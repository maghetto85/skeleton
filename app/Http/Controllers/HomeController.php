<?php

namespace App\Http\Controllers;

use App\AdminMenu;
use App\HomeBanner;
use App\HomeFoto;
use App\Locale;
use App\MenuV;
use App\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {

        $menu = AdminMenu::whereVisibile(1)->orderBy('posizione')->get();
        $month = request('month', date('m', time()));
        $year = request('year', date('Y', time()));
        $monthdays = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $rooms = Room::with(['prenotations' => function($q) use($month, $year, $monthdays) {

            $first = \Carbon\Carbon::createFromDate($year, $month, 1)->toDateString();
            $last = \Carbon\Carbon::createFromDate($year, $month, $monthdays)->toDateString();

            $q->whereBetween('DataArrivo',[$first, $last]);
            $q->orWhereRaw('DATE_SUB(DataPartenza, INTERVAL 1 DAY) BETWEEN ? AND ?',[$first, $last]);

        }])->orderBy('titolo')->get();

        return view('home', compact('menu','rooms','month','year','monthdays'));
    }

    public function index()
    {
        /** @var Locale $locale */
        $locale = app('locale');

        $homefoto = $locale->homefoto();
        $homefoto = $homefoto->count() ? $homefoto->get() : HomeFoto::whereLang('it')->get();
        
        $homebanner = $locale->homebanner();
        $homebanner = $homebanner->count() ? $homebanner->first() : HomeBanner::whereLang('it')->first();

        $menuv = $locale->menuv();
        $menuv = $menuv->count() ? $menuv->get() : MenuV::whereLang('it')->get();
        
        $rooms = Room::whereHas('pics')->inRandomOrder()->limit(3)->get();

        return view('homepage', compact('homefoto','menuv','homebanner','rooms'));

    }
}
