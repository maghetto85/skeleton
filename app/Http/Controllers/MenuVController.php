<?php

namespace App\Http\Controllers;

use App\MenuV;
use Illuminate\Http\Request;

class MenuVController extends Controller
{
    public function index()
    {
        $menus = MenuV::query();
        $menus->orderBy('position');

        if($q = request('q')) {

            request()->merge(['filtered' => true]);
            $menus->where(function($pages) {
                $pages->whereRaw("titolo like ?", ['%'.request('q') . '%']);
            });
        }

        if($lang = request('lang', session('menuv.lang','it'))) {

            request()->merge(['lang' => $lang]);
            \Session::put('menuv.lang', $lang);

            $menus->whereLang($lang);

        }

        $menus = $menus->paginate(25);

        return view('menuv.index')->with('menus', $menus);
    }

    public function create()
    {
        $menu = New MenuV();
        $menu->lang = request('lang', session('menuv.lang','it'));
        return $this->edit($menu);
    }

    public function edit(MenuV $menu)
    {
        return view('menuv.form',compact('menu'));
    }

    public function show(MenuV $menu)
    {
        return $this->edit($menu);
    }

    public function store()
    {
        return $this->update(request(), 0);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'titolo' => "required|string",
            'url' => "required|string",
            'lang' => 'required|exists:locales,code'
        ]);

        if(!request('position')) {

            $request->merge([
                'position' => MenuV::whereLang(request('lang'))->max('position')+1
            ]);

        }

        $menu = MenuV::updateOrCreate(['id' => $id], $request->all());

        if($menu->wasRecentlyCreated) {
            return redirect()->action('MenuVController@edit', $menu->id);
        }

        return redirect()->action('MenuVController@index');
    }

    public function destroy(MenuV $menu)
    {
        $menu->delete();

        return redirect()->action('MenuVController@index');
    }
}
