<?php

namespace App\Http\Controllers;

use App\AdminMenu;
use App\Room;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $adminmenu = \App\AdminMenu::query();

        if($q = request('q')) {

            $adminmenu->where(function($users) {
                $users->whereRaw("titolo like ?", [request('q') . '%']);
                $users->OrWhereRaw("url like ?", [request('q') . '%']);
            });
        }

        $adminmenu = $adminmenu->orderBy('posizione')->paginate(25);

        return view('admin-menu.index', compact('adminmenu'));
    }

    public function create()
    {
        $adminmenu = new AdminMenu();
        return view('admin-menu.form', compact('adminmenu'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function edit($id)
    {
        $adminmenu = AdminMenu::find($id);
        return view('admin-menu.form', compact('adminmenu'));
    }

    public function store()
    {
        return $this->update(request(), 0);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'titolo' => 'required|string',
            'url' => "required|string",
        ]);

        $adminmenu = AdminMenu::query()->updateOrCreate(['id' => $id], $request->all());

        return redirect()->action('AdminMenuController@index');
    }

    public function destroy($id)
    {
        AdminMenu::destroy($id);
        return redirect()->action('AdminMenuController@index');
    }

}
