<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Prenotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

class PrenotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCustomerData($id)
    {
        $customer = Customer::find($id);
        return $customer;
    }

    public function index()
    {
        $prenotations = Prenotation::query();

        if($q = request('q')) {

            request()->merge(['filtered' => true]);
            $prenotations->where(function($prenotations) {
                $prenotations->whereRaw("concat(nome,' ', cognome) like ?", [request('q') . '%']);
                $prenotations->OrWhereRaw("email like ?", [request('q') . '%']);
                $prenotations->OrWhereRaw("telefono like ?", [request('q') . '%']);
                $prenotations->OrWhereRaw("nome like ?", [request('q') . '%']);
                $prenotations->OrWhereRaw("cognome like ?", [request('q') . '%']);
            });
        }

        if(($stato = request('stato')) || $stato === "0") {
            request()->merge(['filtered' => true]);
            $prenotations = $prenotations->whereStato($stato);
        }
        if(($origine = request('origine')) || $origine === "0") {
            request()->merge(['filtered' => true]);
            $prenotations = $prenotations->whereOrigine($origine);
        }
        
        if($room_id = request('room_id')) {
            request()->merge(['filtered' => true]);
            $prenotations = $prenotations->whereIdcamera($room_id);
        }
        
        if($DataArrivo = request('DataArrivo')) {
            request()->merge(['filtered' => true]);
            $prenotations = $prenotations->whereDate('DataArrivo','>=', $DataArrivo);
        }
        
        if($DataPartenza = request('DataPartenza')) {
            request()->merge(['filtered' => true]);
            $prenotations = $prenotations->whereDate('DataPartenza','<=', $DataPartenza);
        }
        
        if(!$showOld = request('showOld')) {
            $prenotations = $prenotations->whereDate('DataPartenza','>=', Carbon::today());
        } else
            request()->merge(['filtered' => true]);

        $prenotations = $prenotations->latest('DataInserimento')->paginate(25);
        $prenotations->appends('q', $q);
        $prenotations->appends('room_id', $room_id);
        $prenotations->appends('stato', $stato);
        $prenotations->appends('showOld', $showOld);
        $prenotations->appends('DataArrivo', $DataArrivo);
        $prenotations->appends('DataPartenza', $DataPartenza);

        return view('prenotations.index', compact('prenotations'));
    }

    public function show($id)
    {
        return $this->edit($id);
    }

    public function create()
    {
        $prenotation = new Prenotation();
        $prenotation->DataArrivo = request('DataArrivo');
        $prenotation->DataPartenza = request('DataPartenza');
        $prenotation->idcamera = request('room_id');
        return view('prenotations.form', compact('prenotation'));
    }

    public function edit($id)
    {
        $prenotation = Prenotation::find($id);
        if(!$prenotation)
            abort(404);

        return view('prenotations.form', compact('prenotation'));
    }

    public function store(Request $request)
    {
        return $this->update($request);
    }

    public function update(Request $request, $id = 0)
    {
        $dp = $request->get('editPaymentData');

        $this->validate($request,[
            'nome' => 'required',
            'email' => 'email',
            'idcamera' => 'required|exists:camere,id',
            'dataarrivo' => 'required|date',
            'datapartenza' => 'required|date',
            'nradulti' => 'numeric',
            'nrbambini' => 'numeric',
            'totale' => 'numeric',
            'acconto' => 'numeric',

            'totale_prenotazione' => 'numeric'.($dp ? '|required' : ''),
            'acconto_versato' => 'numeric'.($dp ? '|required' : ''),
            'data_pagamento_acconto' => 'date',
            'data_pagamento_saldo' => 'date',
            'saldo_versato' => 'numeric'.($dp ? '|required' : ''),
            'totale_versato' => 'numeric'.($dp ? '|required' : ''),
        ]);

        \DB::beginTransaction();

        $data = [
            'idcliente' => $request->get('idcliente'),
            'idcamera' => $request->get('idcamera'),
            'stato' => $request->get('stato'),
            'Nome' => $request->get('nome'),
            'Cognome' => $request->get('cognome'),
            'Telefono' => $request->get('telefono'),
            'Email' => $request->get('email'),
            'DataArrivo' => $request->get('dataarrivo'),
            'checkin' => $request->get('checkin'),
            'DataPartenza' => $request->get('datapartenza'),
            'NrAdulti' => (int)$request->get('nradulti'),
            'NrBambini' => (int)$request->get('nrbambini'),
            'Note' => $request->get('note'),
            'acconto' => $request->get('acconto'),
            'totale' => $request->get('totale')
        ];

        if($dp) {
            $data = array_merge($data, ['totale_prenotazione' => $request->get('totale_prenotazione'),
                'totale_versato' => $request->get('totale_versato'),
                'acconto_versato' => $request->get('acconto_versato'),
                'saldo_versato' => $request->get('saldo_versato'),
                'stato_pagamento_acconto' => $request->get('stato_pagamento_acconto'),
                'data_pagamento_acconto' => $request->get('data_pagamento_acconto') ? $request->get('data_pagamento_acconto') : null,
                'stato_pagamento_saldo' => $request->get('stato_pagamento_saldo'),
                'data_pagamento_saldo' => $request->get('data_pagamento_saldo') ? $request->get('data_pagamento_saldo') : null,
            ]);
        }

        if($data['idcliente'] == -1) {
            $customer = Customer::create($request->only('nome','cognome','telefono','email'));
            $data['idcliente'] = $customer->id;
        }

        $prenotation = Prenotation::firstOrNew(['id' => $id]);

        $prenotation->fill($data);

        $prenotation->save();

        \DB::commit();

        return redirect()->route('prenotations.index')->with('updated', $prenotation);

    }

    public function destroy($id)
    {
        $prenotation = Prenotation::find($id);
        if($prenotation) {
            $prenotation->delete();
            return back()->with('deleted', $prenotation);
        }

        return back();
    }

    public function getInviaConfermaDisp(Prenotation $id)
    {
        return [
            'subject' => 'Conferma Disponibilità Camera - Halex',
            'html' => get_option("prenotazioni.email.conferma")
        ];

    }

    public function getInviaConfermaPrenotazione(Prenotation $id)
    {
        return [
            'subject' => 'Conferma Prenotazione - Halex',
            'html' => get_option("email.cameraconfermata.body")
        ];
    }

    public function postInviaConferma(Prenotation $prenotation)
    {
        if($prenotation->exists && $prenotation->Email) {

            $message = request('message');
            $type = request('type');
            $message = str_replace("[dataarrivo]", $prenotation->DataArrivo, $message);
            $message = str_replace("[datapartenza]", $prenotation->DataPartenza, $message);
            $message = str_replace("[camera_titolo]", $prenotation->room->titolo, $message);

            $titolo = "Prenotazione Halex dal {$prenotation->DataArrivo} al {$prenotation->DataPartenza}, Camera {$prenotation->room->titolo}";

            $sandbox = get_option('paypal.sandbox') ? 'sandbox.' : '';
            $account = get_option('paypal.email');

            $acconto = "https://www.{$sandbox}paypal.com/cgi-bin/webscr/?cmd=_xclick&business={$account}&item_name=Acconto su {$titolo}&amount={$prenotation->acconto}";
            $acconto.= "&currency_code=EUR&lc=IT&notify_url=http://www.halex.it/admin/paypal_ipn.asp&return=http://www.halex.it/conferma_pagamento";
            $acconto = "<a href=\"$acconto\">Effettua Ora il Pagamento con PayPal</a>";

            $saldo = "https://www.{$sandbox}paypal.com/cgi-bin/webscr/?cmd=_xclick&business={$account}&item_name=Saldo {$titolo}&amount={$prenotation->totale}";
            $saldo.= "&currency_code=EUR&lc=IT&notify_url=http://www.halex.it/admin/paypal_ipn.asp&return=http://www.halex.it/conferma_pagamento";
            $saldo = "<a href=\"$saldo\">Effettua Ora il Pagamento con PayPal</a>";

            $message = str_replace("[link_paypal_acconto]", $acconto, $message);
            $message = str_replace("[link_paypal_saldo]", $saldo, $message);


            foreach($prenotation->getAttributes() as $name => $value) {
                $name = strtolower($name);
                $message = str_replace("[$name]", $value, $message);
            }




            $subject = request('subject');

            \Mail::raw(strip_tags($message), function (Message $mail) use($prenotation, $subject, $message) {
                $mail->to($prenotation->Email, trim($prenotation->Nome.' '.$prenotation->Cognome));
                $mail->setBody($message, 'text/html');
                $mail->subject($subject);

            });

            $prenotation->update([$type => \Carbon\Carbon::now()]);

            return $prenotation;

        }

        return [];

    }

}
