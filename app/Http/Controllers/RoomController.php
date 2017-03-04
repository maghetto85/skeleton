<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rooms = \App\Room::query();

        if($q = request('q')) {

            $rooms->where(function($rooms) {
                $rooms->whereRaw("titolo like ?", ['%'.request('q') . '%']);
            });
        }

        $rooms = $rooms->paginate(25);

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $room = new Room();
        return view('rooms.form', compact('room'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function edit($id)
    {
        $room = Room::find($id);
        return view('rooms.form', compact('room'));
    }

    public function store()
    {
        return $this->update(request(), 0);
    }

    public function upload(Request $request)
    {
        $id = $request->get('id');
        $file = $request->file('file');

        $room = Room::find($id);

        if(!$room)
            return ['errore' => 'Foto non valida'];

        if(!$file->isValid())
            return ['errore' => 'Foto non valida'];

        $ext = '.'.$file->getClientOriginalExtension();
        $name = str_replace($ext, '', $file->getClientOriginalName());

        return request()->all();

        $prefix = '';
        $i = 0;
        while(\File::exists(app_path('../../httpdocs/uploads/home/'.($fname = $name.$prefix.$ext)))) {
            $i++;
            $prefix = "[$i]";
        }

        $file->move(app_path('../../httpdocs/uploads/home/'), $fname);
        $url = '/uploads/home/'.$fname;

        $homefoto->update(['url' => $url]);
        $homefoto->url = $url;

        return $homefoto;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'titolo' => 'required|string',
            'descrizione' => "required|string",
            'descrizione_en' => "required|string",
        ]);

        $langs = [];
        foreach(\App\Locale::all(['id','code']) as $locale) {
            $description = array_get($request->get("{$locale->code}",[]), 'descrizione');

            if($description) {
                $langs[$locale->id] = ['description' => $description];
            }
        }

        $room = Room::query()->updateOrCreate(['id' => $id], $request->only('titolo','descrizione','descrizione_en'));
        $room->locales()->sync($langs, true);

        if($room->wasRecentlyCreated) {
            return redirect()->action('RoomController@edit', $room->id);
        }

        return redirect()->action('RoomController@index');
    }

    public function destroy($id)
    {
        Room::destroy($id);
        return redirect()->action('RoomController@index');
    }

}
