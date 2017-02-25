@extends('layouts.app')
@section('page.title','Fatture')
@section('page.navbar')
    <li><a href="{{ route('invoices.index') }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Fatture</a></li>
@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $invoice->exists ? route('invoices.update', $invoice->id) : route('invoices.store') }}">
        {{ csrf_field() }}
        @if($invoice->exists)
            {{ method_field('put') }}
        @endif
        
        @if($errors->count())

            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <strong>Errori nella compilazione del modulo:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">@if($invoice->exists) Modifica Fattura @else Nuova Fattura @endif</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group form-group-sm">
                            <label for="numero" class="control-label">Numero:</label>
                            <div class="input-group">
                                <input type="text" name="numero" id="numero" class="form-control text-right" readonly value="{{ old('numero', $invoice->numero) }}">
                                <span class="input-group-addon">
                                    / {{ (new Carbon\Carbon(old('data', $invoice->data)))->year }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group form-group-sm">
                            <label for="data" class="control-label">Data:</label>
                            <input type="date" name="data" id="data" class="form-control" value="{{ old('data', $invoice->data ? $invoice->data->toDateString() : null) }}">
                        </div>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group form-group-sm">
                            <label for="idcliente" class="control-label">Cliente:</label>
                            <select name="idcliente" id="idcliente" class="form-control">
                                <option value="0">-- Nessun Cliente --</option>
                                <option value="-1"{{ old('idcliente') == 1 ? ' selected' :'' }}>-- Crea una nuova scheda --</option>
                                @foreach(\App\Customer::orderBy('Nome')->get() as $customer)
                                    <option value="{{ $customer->id }}"{{ old('idcliente', $invoice->idcliente) == $customer->id ? ' selected' : '' }}>{{ $customer->NomeCognome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group form-group-sm">
                            <label for="idprenotazione" class="control-label">Prenotazione:</label>
                            <select name="idprenotazione" id="idprenotazione" class="form-control">
                                <option value="0">-- Nessuna Prenotazione --</option>
                                @foreach(\App\Prenotation::whereDoesntHave('invoice')->latest('DataInserimento')->get() as $prenotation)
                                    <option value="{{ $prenotation->id }}"{{ old('idprenotazione', $invoice->idprenotazione) == $prenotation->id ? ' selected' : '' }}>{{ $prenotation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix visible-sm"></div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome" class="control-label">Nome:</label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome', $invoice->Nome) }}" class="form-control">
                            @if($errors->has('nome'))
                                <p class="help-block">
                                    {{ $errors->first('nome') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('indirizzo') ? ' has-error' : '' }}">
                            <label for="indirizzo" class="control-label">Indirizzo:</label>
                            <input type="text" id="indirizzo" name="indirizzo" value="{{ old('indirizzo', $invoice->Indirizzo) }}" class="form-control">
                            @if($errors->has('indirizzo'))
                                <p class="help-block">
                                    {{ $errors->first('indirizzo') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="visible-sm clearfix"></div>
                    <div class="col-lg-1 col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('cap') ? ' has-error' : '' }}">
                            <label for="cap" class="control-label">Cap:</label>
                            <input type="text" id="cap" name="cap" value="{{ old('cap', $invoice->Cap) }}" class="form-control">
                            @if($errors->has('cap'))
                                <p class="help-block">
                                    {{ $errors->first('cap') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-5">
                        <div class="form-group form-group-sm{{ $errors->has('citta') ? ' has-error' : '' }}">
                            <label for="citta" class="control-label">Citta:</label>
                            <input type="text" id="citta" name="citta" value="{{ old('citta', $invoice->Citta) }}" class="form-control">
                            @if($errors->has('citta'))
                                <p class="help-block">
                                    {{ $errors->first('citta') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <div class="form-group form-group-sm{{ $errors->has('provincia') ? ' has-error' : '' }}">
                            <label for="provincia" class="control-label">Provincia:</label>
                            <input type="text" id="provincia" name="provincia" value="{{ old('provincia', $invoice->Provincia) }}" class="form-control">
                            @if($errors->has('provincia'))
                                <p class="help-block">
                                    {{ $errors->first('provincia') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('codicefiscale') ? ' has-error' : '' }}">
                            <label for="codicefiscale" class="control-label">Codice Fiscale:</label>
                            <input type="text" id="codicefiscale" name="codicefiscale" value="{{ old('codicefiscale', $invoice->CodiceFiscale) }}" class="form-control">
                            @if($errors->has('codicefiscale'))
                                <p class="help-block">
                                    {{ $errors->first('codicefiscale') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('partitaiva') ? ' has-error' : '' }}">
                            <label for="partitaiva" class="control-label">Partita Iva:</label>
                            <input type="text" id="partitaiva" name="partitaiva" value="{{ old('partitaiva', $invoice->PartitaIva) }}" class="form-control">
                            @if($errors->has('partitaiva'))
                                <p class="help-block">
                                    {{ $errors->first('partitaiva') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('costocamera') ? ' has-error' : '' }}">
                            <label for="costocamera" class="control-label">Costo Camera:</label>
                            <input type="number" step="0.01" id="costocamera" name="costocamera" value="{{ old('costocamera', $invoice->costocamera) }}" class="form-control">
                            @if($errors->has('costocamera'))
                                <p class="help-block">
                                    {{ $errors->first('costocamera') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    
                </div>


                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('invoices') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Corpo Fattura</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th class="col-sm-1"></th>
                        <th class="col-sm-8">Descrizione</th>
                        <th class="text-right col-sm-3">Importo</th>
                    </tr>
                    </thead>
                    <tbody id="body">
                @if($invoice->exists)
                    @foreach($invoice->services as $service)

                    <tr{!! !$service->row ? ' class="prenotation"' : '' !!}>
                        <td class="text-right">@if($service->row)<button class="btn btn-danger btn-sm" type="button" onclick="$(this).parents('tr').first().remove(); calcolaImporti()"><i class="fa fa-times"></i></button>@endif</td>
                        <td><input type="text" name="description[]" id="description[]" class="form-control input-sm" value="{{ $service->titolo }}"></td>
                        <td>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">
                                    <i class="fa fa-eur"></i>
                                </span>
                                <input type="number" step="0.01" name="amount[]" class="text-right form-control input-sm" value="{{ $service->prezzo }}">
                            </div>
                        </td>
                    </tr>

                    @endforeach
                @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2" class="text-right">Totale Imponibile:</td>
                        <th class="text-right imponibile"></th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right">Totale Iva:</td>
                        <th class="text-right iva"></th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right">Totale Fattura: <input type="hidden" name="totalefattura" id="totalefattura" value="{{ old('totalefattura',$invoice->totalefattura) }}"></td>
                        <th class="text-right totaleivato"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="panel-body">
                <button class="btn btn-primary">Salva</button>
                <a href="{{ url('invoices') }}" class="btn btn-link">Torna Indietro</a>
                <button class="pull-right btn btn-success aggiungi_servizio"><i class="fa fa-plus fa-fw"></i> Aggiungi</button>
            </div>
        </div>
    </form>


</div>
@endsection

@section('bottom')

    <script>

        var $body = $('tbody#body'), originalFirstRow = '{{ $invoice->services()->count() ? $invoice->services()->first()->titolo : old('description',[''])[0]}}';

        $(function() {

            $('select#idcliente').change(function(e) {

                var id = $(this).val();
                if(id && id > -1) {

                    $.getJSON('{{ route('prenotations.customer-data', null) }}/'+id, function(data) {

                        if(!$('input#nome').val()) $('input#nome').val(data.nome_cognome);
                        if(!$('input#indirizzo').val()) $('input#indirizzo').val(data.indirizzo);

                    });

                }

            }).change();

            $('select#idprenotazione').change(function(e) {

                var id = $(this).val(), importo = parseFloat($('#costocamera').val()), titolo = originalFirstRow;
                if(isNaN(importo)) importo = 0;
                if(id > 0) {

                    $.getJSON('{{ route('invoices.prenotation-data', null) }}/'+id, function(data) {

                        if(data) {

                            titolo = 'Prenotazione Camera '+data.name;
                            importo = data.totale || importo;

                            $body.find('tr.prenotation').remove();
                            $body.prepend('<tr class="prenotation">\n    <td></td>\n    <td><input type="text" name="description[]" id="description[]" class="form-control input-sm" value="'+titolo+'"></td>\n    <td>\n        <div class="input-group input-group-sm">\n            <span class="input-group-addon">\n                <i class="fa fa-eur"></i>\n            </span>\n            <input type="number" step="0.01" name="amount[]" value="'+importo+'" class="text-right form-control input-sm">\n        </div>\n    </td>\n</tr>');

                            calcolaImporti();
                        }

                    });

                } else {

                    $body.find('tr.prenotation').remove();
                    $body.prepend('<tr class="prenotation">\n    <td></td>\n    <td><input type="text" name="description[]" id="description[]" class="form-control input-sm" value="'+titolo+'"></td>\n    <td>\n        <div class="input-group input-group-sm">\n            <span class="input-group-addon">\n                <i class="fa fa-eur"></i>\n            </span>\n            <input type="number" step="0.01" name="amount[]" value="'+importo+'" class="text-right form-control input-sm">\n        </div>\n    </td>\n</tr>');
                    calcolaImporti();
                }

            }).change();

            $('button.aggiungi_servizio').click(function(e) {
                e.preventDefault();

                $body.append('<tr>\n    <td class="text-right"><button class="btn btn-danger btn-sm" type="button" onclick="$(this).parents(\'tr\').first().remove(); calcolaImporti()"><i class="fa fa-times"></i></button></td>\n    <td><input type="text" name="description[]" id="description[]" class="form-control input-sm"></td>\n    <td>\n        <div class="input-group input-group-sm">\n            <span class="input-group-addon">\n                <i class="fa fa-eur"></i>\n            </span>\n            <input type="number" step="0.01" name="amount[]" class="text-right form-control input-sm">\n        </div>\n    </td>\n</tr>');

            });

            $('input#costocamera').change(function() {
                $body.find('tr.prenotation input[type=number]').val($(this).val());
            }).change();

            $('body').on('tr.prenotation input[type=text]').change(function(e) {

                if($(this).val())
                    originalFirstRow = $(this).val();

            }).on('change','input[type=number]', function() {
                calcolaImporti();
            })
        });

        function calcolaImporti() {

            var corpo = 0, iva = 0;

            $body.find('input[type=number]').each(function(id, row) {
                var importo = parseFloat($(row).val());
                if(!isNaN(importo))
                    corpo+= importo;
            });

            iva = corpo - (corpo /1.10);

            $('.totaleivato').html('&euro; '+(corpo).toMoney(2,',','.'));
            $('.imponibile').html('&euro; '+(corpo-iva).toMoney(2,',','.'));
            $('.iva').html('&euro; '+(iva).toMoney(2,',','.'));
            $('input#totalefattura').val(corpo);

        }

    </script>

@endsection
