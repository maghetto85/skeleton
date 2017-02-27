<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::query()->orderBy('nome')->orderBy('cognome');

        if($q = request('q')) {

            if(preg_match("/^(IT){0,1}[0-9]{11}$/i", $q)) {

                $customers->wherePartitaiva($q);

            } elseif(preg_match('/^[a-z]{6}[0-9]{2}[a-z][0-9]{2}[a-z][0-9]{3}[a-z]$/i', $q) ) {

                $customers->whereCodicefiscale($q);

            } else {

                $customers->where(function ($customers) {
                    $customers->orWhereRaw("email like ?", ['%' . request('q') . '%']);
                    $customers->orWhereRaw("concat(nome,' ',cognome) like ?", ['%' . request('q') . '%']);
                });
            }

            request()->merge(['filtered' => true]);

        }

        $customers = $customers->paginate(25);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $customer = new Customer();
        return view('customers.form', compact('customer'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.form', compact('customer'));
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
        ]);

        $customer = Customer::query()->updateOrCreate(['id' => $id], $request->all());

        if($customer->wasRecentlyCreated) {
            return redirect()->action('CustomerController@edit', $customer->id);
        }

        return redirect()->action('CustomerController@index');
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect()->action('CustomerController@index');
    }

}
