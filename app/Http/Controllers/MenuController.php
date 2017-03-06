<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::query();
        $menus->orderBy('position');

        $parent = request('parent',0);
        $menus->whereParent($parent);
        if($parent) request(['filtered' => true]);

        if($q = request('q')) {

            request()->merge(['filtered' => true]);
            $menus->where(function($pages) {
                $pages->whereRaw("titolo like ?", ['%'.request('q') . '%']);
            });
        }

        if($lang = request('lang', session('menu.lang','it'))) {

            request()->merge(['lang' => $lang]);
            \Session::put('menu.lang', $lang);

            $menus->whereLang($lang);

        }

        $menus = $menus->paginate(25);

        return view('menu.index')->with('menus', $menus);
    }

    public function create()
    {
        $menu = New Menu();
        $menu->parent = request('parent',0);
        $menu->lang = request('lang', session('menu.lang','it'));
        return $this->edit($menu);
    }

    public function edit(Menu $menu)
    {
        if($menu->exists)
            $menus = $menu->submenus()->orderBy('position')->paginate(25);

        return view('menu.form',compact('menu','menus'));
    }

    public function show(Menu $menu)
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
                'position' => Menu::whereLang(request('lang'))->whereParent(request('parent'))->max('position')+1
            ]);

        }

        /** @var Menu $menu */
        $menu = Menu::updateOrCreate(['id' => $id], $request->all());

        if($menu->wasRecentlyCreated) {

            if($menu->parent)
                return redirect()->action('MenuController@edit', $menu->parent);
            else
                return redirect()->action('MenuController@edit', $menu->id);
        }

        if($menu->parent)
            return redirect()->action('MenuController@edit', $menu->parent);
        else
            return redirect()->action('MenuController@index');
    }

    public function move(Menu $menu)
    {
        $pos = request('position');
        if($menu) {

            Menu::whereLang($menu->lang)->wherePosition($pos)->update(['position' => $menu->position]);
            $menu->position = $pos;
            $menu->save();

        }

        return $menu;
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        if($menu->parent)
            return redirect()->action('MenuController@edit', $menu->parent);

        return redirect()->action('MenuController@index');
    }
}
