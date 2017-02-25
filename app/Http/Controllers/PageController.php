<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pages = \App\Page::query();

        if($q = request('q')) {

            request()->merge(['filtered' => true]);
            $pages->where(function($pages) {
                $pages->whereRaw("titolo like ?", ['%'.request('q') . '%']);
            });
        }

        if($lang = request('lang')) {

            request()->merge(['filtered' => true]);
            $pages->whereLang($lang);

        }

        $pages = $pages->paginate(25);

        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        $page = new Page();
        return view('pages.form', compact('page'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function edit($id)
    {
        $page = Page::find($id);
        return view('pages.form', compact('page'));
    }

    public function store()
    {
        return $this->update(request(), 0);
    }

    public function upload(Request $request)
    {
        $id = $request->get('id');
        $file = $request->file('file');

        $page = Page::find($id);

        if(!$page)
            return ['errore' => 'Foto non valida'];

        if(!$file->isValid())
            return ['errore' => 'Foto non valida'];

        $ext = '.'.$file->getClientOriginalExtension();
        $name = str_replace($ext, '', $file->getClientOriginalName());

        return request()->all();

        $prefix = '';
        $i = 0;
        while(\File::exists(app_path('../../httpdocs/uploads/pages/'.($fname = $name.$prefix.$ext)))) {
            $i++;
            $prefix = "[$i]";
        }

        $file->move(app_path('../../httpdocs/uploads/pages/'), $fname);
        $url = '/uploads/home/'.$fname;

        $homefoto->update(['url' => $url]);
        $homefoto->url = $url;

        return $homefoto;
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'Slug' => "required|string|unique:pagine,Slug,$id",
            'Titolo' => "required|string",
            'Contenuto' => "required|string",
        ]);

        $page = Page::query()->updateOrCreate(['id' => $id], $request->all());

        if($page->wasRecentlyCreated) {
            return redirect()->action('PageController@edit', $page->id);
        }

        return redirect()->action('PageController@index');
    }

    public function destroy($id)
    {
        Page::destroy($id);
        return redirect()->action('PageController@index');
    }

}
