<?php

namespace App\Http\Controllers;

use App\AdminMenu;
use App\AdminUser;
use App\Room;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $adminusers = \App\AdminUser::query();

        if($q = request('q')) {

            $adminusers->where(function($users) {
                $users->whereRaw("nome like ?", [request('q') . '%']);
                $users->OrWhereRaw("nomeutente like ?", [request('q') . '%']);
                $users->OrWhereRaw("email like ?", [request('q') . '%']);
            });
            $filters = true;

        }

        $adminusers = $adminusers->paginate(25);

        return view('admin-users.index', compact('adminusers'));
    }

    public function create()
    {
        $adminuser = new AdminUser();
        return view('admin-users.form', compact('adminuser'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function edit($id)
    {
        $adminuser = AdminUser::find($id);
        return view('admin-users.form', compact('adminuser'));
    }

    public function store()
    {
        return $this->update(request(), 0);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'Nome' => 'required|string',
            'email' => "required|email|unique:admin_users,email,$id,IdUtente",
            'NomeUtente' => "required|unique:admin_users,NomeUtente,$id,IdUtente",
            'password' => 'string'.(!$id ? '|required' : ''),
        ]);

        $adminuser = AdminUser::query()->updateOrCreate(['IdUtente' => $id], $request->all());

        return redirect()->action('AdminUserController@index');
    }

    public function destroy($id)
    {
        AdminUser::destroy($id);
        return redirect()->action('AdminUserController@index');
    }

}
