<?php

namespace App\Http\Controllers;

use App\FotoRoom;
use App\Room;
use Illuminate\Http\Request;
use Imagine\Image\Box;
use Storage;

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
            return ['errore' => 'Camera non valida'];

        if(!$file->isValid())
            return ['errore' => 'Foto non valida'];


        $fname = str_random(30).'.'.$file->getClientOriginalExtension();

        $url = '/'.$file->storePubliclyAs("uploads/rooms/{$room->id}", $fname, 'halex');
        $miniatura = "/uploads/rooms/{$room->id}/th/$fname";

        Storage::disk('halex')->copy($url, $miniatura);

        $image = new \Imagine\Gd\Imagine();
        $image = $image->open(public_path($miniatura));

        $image->thumbnail(new Box(100, 100))->save();

        $picture = new FotoRoom();
        $picture->room()->associate($room);
        $picture->posizione = $room->pics()->max('posizione')+1;
        $picture->miniatura = $miniatura;
        $picture->url = $url;
        $picture->save();

        return $picture;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'titolo' => 'required|string'
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

    public function removeImage(Room $room, $id)
    {
        $image = $room->pics()->find($id);
        if($image) {
            $image->delete();
        }

        return $image;
    }

    public function moveImage(Room $room, $id)
    {
        $pos = request('position');
        $image = $room->pics()->find($id);
        if($image) {

            $room->pics()->wherePosizione($pos)->update(['Posizione' => $image->posizione]);
            $image->posizione = $pos;
            $image->save();
        }

        return $image;
    }

    public function toggleImage(Room $room, $id)
    {
        $image = $room->pics()->find($id);
        if($image) {

            $image->visibile = !$image->visibile;
            $image->save();
        }

        return $image;
    }

    public function destroy($id)
    {
        Room::destroy($id);
        return redirect()->action('RoomController@index');
    }

}
