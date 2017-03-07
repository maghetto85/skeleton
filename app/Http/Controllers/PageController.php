<?php

namespace App\Http\Controllers;

use App\Page;
use App\PagePicture;
use Illuminate\Http\Request;
use Imagine\Image\Box;

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

        $url = '/'. $file->storeAs("uploads/pages/{$page->Id}", $file->getClientOriginalName(), 'halex');
        $fname = pathinfo($url, PATHINFO_BASENAME);
        $miniatura = "/uploads/pages/{$page->Id}/th/".$fname;

        \Storage::disk('halex')->copy($url, $miniatura);

        $image = new \Imagine\Gd\Imagine();
        $image = $image->open(\Storage::disk('halex')->url($miniatura));

        $image->thumbnail(new Box(100, 100))->save();

        $picture = new PagePicture();
        $picture->page()->associate($page);
        $picture->IdFoto = $page->pictures()->max('idfoto')+1;
        $picture->Url = $url;
        $picture->Miniatura = $miniatura;
        $picture->Posizione = $page->pictures()->max('Posizione')+1;
        $picture->save();

        return $picture;
    }

    public function removeImage(Page $page, $id)
    {
        $image = $page->pictures()->find($id);
        if($image) {
            $image->delete();
        }

        return $image;
    }

    public function moveImage(Page $page, $id)
    {
        $pos = request('position');
        $image = $page->pictures()->find($id);
        if($image) {

            $page->pictures()->wherePosizione($pos)->update(['Posizione' => $image->Posizione]);
            $image->posizione = $pos;
            $image->save();

        }

        return $image;
    }



    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'Slug' => "required|string|unique:paginec,slug|unique:pagine,Slug,$id",
            'Titolo' => "required|string",
            'Contenuto' => "required|string",
        ]);

        $page = Page::query()->updateOrCreate(['id' => $id], $request->all());

        if($page->wasRecentlyCreated) {
            return redirect()->action('PageController@edit', $page->Id);
        }

        return redirect()->action('PageController@index');
    }

    public function destroy($id)
    {
        Page::destroy($id);
        return redirect()->action('PageController@index');
    }

}
