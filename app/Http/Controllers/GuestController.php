<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $guests = Guest::query()->orderBy('nome')->orderBy('cognome');

        if($q = request('q')) {

            $guests->where(function ($guests) {
                $guests->orWhereRaw("email like ?", ['%' . request('q') . '%']);
                $guests->orWhereRaw("concat(nome,' ',cognome) like ?", ['%' . request('q') . '%']);
            });

            request()->merge(['filtered' => true]);
        }

        $guests = $guests->paginate(25);

        return view('guests.index', compact('guests'));
    }

    public function create()
    {
        $guest = new Guest();
        return view('guests.form', compact('guest'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function edit($id)
    {
        $guest = Guest::find($id);
        return view('guests.form', compact('guest'));
    }

    public function store()
    {
        return $this->update(request(), 0);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nome' => 'required|string',
            'email' => "email",
            'datanascita' => 'required|date',
        ]);

        $data = $request->all();
        if(!$data['datanascita']) $data['datanascita'] = null;
        if(!$data['datarilascio']) $data['datarilascio'] = null;
        if(!$data['datascadenza']) $data['datascadenza'] = null;

        $guest = Guest::query()->updateOrCreate(['id' => $id], $data);

        if($guest->wasRecentlyCreated) {
            return redirect()->action('GuestController@edit', $guest->id);
        }

        return redirect()->action('GuestController@index');
    }

    public function destroy($id)
    {
        Guest::destroy($id);
        return redirect()->action('GuestController@index');
    }

}
