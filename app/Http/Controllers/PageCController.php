<?php

namespace App\Http\Controllers;

use App\Page;
use App\PageC;
use App\PagePicture;
use Illuminate\Http\Request;
use Imagine\Image\Box;

class PageCController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pages = \App\PageC::query();

        if($q = request('q')) {

            request()->merge(['filtered' => true]);
            $pages->where(function($pages) {
                $pages->whereRaw("titolo like ?", ['%'.request('q') . '%']);
            });
        }

        if($lang = request('lang',session('pagesc.lang','it'))) {

            request()->merge(['lang' => $lang]);
            \Session::put('pagesc.lang', $lang);
            $pages->whereLang($lang);

        }

        $pages = $pages->paginate(25);

        return view('pagesc.index', compact('pages'));
    }

    public function create()
    {
        $page = new PageC();
        return view('pagesc.form', compact('page'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function edit($id)
    {
        $page = PageC::find($id);
        return view('pagesc.form', compact('page'));
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

        if(!is_dir(app_path("../../httpdocs/uploads/pages/{$page->Id}/")))
            mkdir(app_path("../../httpdocs/uploads/pages/{$page->Id}/th"),0777, true);

        $prefix = '';
        $i = 0;
        while(\File::exists(app_path("../../httpdocs/uploads/pages/{$page->Id}/".($fname = $name.$prefix.$ext)))) {
            $i++;
            $prefix = "[$i]";
        }

        $image = new \Imagine\Gd\Imagine();
        $image = $image->open($file->getRealPath());

        $image->copy()->thumbnail(new Box(100, 100))->save(app_path("../../httpdocs/uploads/pages/{$page->Id}/th/$fname"));

        $file->move(app_path("../../httpdocs/uploads/pages/{$page->Id}"), $fname);

        $url = "/uploads/pages/{$page->Id}/".$fname;
        $miniatura = "/uploads/pages/{$page->Id}/th/".$fname;

        $picture = new PagePicture();
        $picture->page()->associate($page);
        $picture->IdFoto = $page->pictures()->max('idfoto')+1;
        $picture->Url = $url;
        $picture->Miniatura = $miniatura;
        $picture->Posizione = $page->pictures()->max('Posizione')+1;
        $picture->save();

        return $picture;
    }



    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'slug' => "required|string|unique:pagine,Slug|unique:paginec,slug,$id",
            'titolo' => "required|string",
        ]);

        $page = PageC::query()->updateOrCreate(['id' => $id], $request->all());

        if($page->wasRecentlyCreated) {
            return redirect()->action('PageCController@edit', $page->id);
        }

        return redirect()->action('PageCController@index');
    }

    public function destroy($id)
    {
        PageC::destroy($id);
        return redirect()->action('PageCController@index');
    }

}
