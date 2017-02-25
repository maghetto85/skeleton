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
        $homefoto = HomeFoto::all();

        return view('homefoto', compact('homefoto'));
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


        $ext = '.'.$file->getClientOriginalExtension();
        $name = str_replace($ext, '', $file->getClientOriginalName());

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

    public function save(Request $request)
    {
        $id = $request->get('id');

        $homefoto = HomeFoto::find($id);
        if($homefoto)
            $homefoto->update($request->all());

        return $homefoto;
    }
}
