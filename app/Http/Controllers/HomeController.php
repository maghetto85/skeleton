<?php

namespace App\Http\Controllers;

use App\AdminMenu;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
}
