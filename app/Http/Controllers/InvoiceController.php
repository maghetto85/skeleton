<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use App\InvoiceService;
use App\Prenotation;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $invoices = Invoice::query();

        if($q = request('q')) {

            request()->merge(['filtered' => true]);
            $invoices->where(function($query) {
                $query->whereRaw("Nome like ?", [request('q') . '%']);
                $query->OrWhereRaw("Indirizzo like ?", [request('q') . '%']);
                $query->OrWhereRaw("PartitaIva like ?", [request('q') . '%']);
                $query->OrWhereRaw("CodiceFiscale like ?", [request('q') . '%']);
            });
        }
        
        $invoices = $invoices->latest('id')->paginate(25);
        $invoices->appends('q', $q);

        return view('invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function create()
    {
        $invoice = new Invoice();
        $invoice->numero = Invoice::whereYear('data','=', date('Y'))->max('numero')+1;
        $invoice->data = date('Y-m-d');

        return view('invoices.form', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice)
            abort(404);

        return view('invoices.form', compact('invoice'));
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function update(Request $request, $id = 0)
    {

        $this->validate($request,[
            'nome' => 'required',
            'totalefattura' => 'required|numeric|min:1',
        ]);

        \DB::beginTransaction();

        $data = $request->except('_token','description','amount');

        $raw = $request->only('description','amount');
        $servizi = [];
        foreach($raw['description'] as $index => $row) {

            $amount = $raw['amount'][$index];
            if($row && $amount) {
                $servizi[] = [
                    'row' => count($servizi),
                    'titolo' => $row,
                    'prezzo' => $amount
                ];
            }

        }

        if($data['idcliente'] == -1) {
            $request->merge(['cognome' => '', 'email' => '']);
            $customer = Customer::create($request->only('nome','cognome','email','cap','codicefiscale','partitaiva','indirizzo','citta'));
            $data['idcliente'] = $customer->id;
        }

        $data['costocamera'] = $servizi[0]['prezzo'];
        $data['Nome'] = $data['nome'];
        $data['Indirizzo'] = $data['indirizzo'];
        $data['Cap'] = $data['cap'];
        $data['Citta'] = $data['citta'];
        $data['Provincia'] = $data['provincia'];
        $data['CodiceFiscale'] = $data['codicefiscale'];
        $data['PartitaIva'] = $data['partitaiva'];
        unset($data['nome'],
            $data['indirizzo'],
            $data['cap'],
            $data['citta'],
            $data['provincia'],
            $data['codicefiscale'],
            $data['partitaiva']);


        /** @var Invoice $invoice */
        $invoice = Invoice::firstOrNew(['id' => $id]);

        $invoice->fill($data);

        $invoice->save();

        $invoice->services()->delete();
        $invoice->services()->createMany($servizi);


        \DB::commit();

        return redirect()->route('invoices.index')->with('updated', $invoice);

    }

    public function getPrenotationData($id)
    {
        $prenotation = Prenotation::with('room')->find($id);
        return $prenotation;
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        if($invoice) {
            $invoice->delete();
            return back()->with('deleted', $invoice);
        }

        return back();
    }
}
