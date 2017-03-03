@extends('layouts.app')
@section('page.title','Prenotazioni')
@section('page.navbar')
    <li><a href="{{ route('prenotations.index') }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Prenotazioni</a></li>
@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $prenotation->exists ? route('prenotations.update', $prenotation->id) : route('prenotations.store') }}">
        {{ csrf_field() }}
        @if($prenotation->exists)
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
                <h3 class="panel-title">@if($prenotation->exists) Modifica Prenotazione @else Nuova Prenotazione @endif</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group form-group-sm">
                            <label for="idcliente" class="control-label">Scheda Cliente:</label>
                            <select name="idcliente" id="idcliente" class="form-control">
                                <option value="0">-- Nessun Cliente --</option>
                                <option value="-1"{{ old('idcliente') == 1 ? ' selected' :'' }}>-- Crea una nuova scheda --</option>
                                @foreach(\App\Customer::orderBy('Cognome')->orderBy('Nome')->get() as $customer)
                                <option value="{{ $customer->id }}"{{ old('idcliente', $prenotation->idcliente) == $customer->id ? ' selected' : '' }}>{{ $customer->CognomeNome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome" class="control-label">Nome:</label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome', $prenotation->Nome) }}" class="form-control">
                            @if($errors->has('nome'))
                                <p class="help-block">
                                    {{ $errors->first('nome') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('cognome') ? ' has-error' : '' }}">
                            <label for="cognome" class="control-label">Cognome:</label>
                            <input type="text" id="cognome" name="cognome" value="{{ old('cognome', $prenotation->Cognome) }}" class="form-control">
                            @if($errors->has('cognome'))
                                <p class="help-block">
                                    {{ $errors->first('cognome') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="control-label">Telefono:</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $prenotation->Telefono) }}" class="form-control">
                            @if($errors->has('telefono'))
                                <p class="help-block">
                                    {{ $errors->first('telefono') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix visible-sm"></div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email:</label>
                            <input type="text" id="email" name="email" value="{{ old('email', $prenotation->Email) }}" class="form-control">
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <label for="stato" class="control-label">Stato:</label>
                            <select id="stato" class="form-control" name="stato">
                                <option value="0">Da Confermare</option>
                                <option value="1"{{ old('stato',$prenotation->stato) == 1 ? ' selected' : '' }}>Confermato</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <label for="idcamera" class="control-label">Camera:</label>
                            <select id="idcamera" class="form-control" name="idcamera">
                                <option value="0">-- Seleziona --</option>
                                @foreach(\App\Room::orderBy('titolo')->get() as $room)
                                <option value="{{ $room->id }}"{{ $room->id == old('idcamera',$prenotation->idcamera) ? ' selected' : '' }}>{{ $room->titolo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <label for="dataarrivo" class="control-label">Data Arrivo</label>
                            <input type="date" name="dataarrivo" class="form-control" id="dataarrivo" value="{{ old('dataarrivo',$prenotation->GiornoArrivo) }}">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <label for="checkin" class="control-label">Check-In</label>
                            <input type="text" name="checkin" class="form-control" id="checkin" value="{{ old('checkin',$prenotation->checkin) }}">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group">
                            <label for="datapartenza" class="control-label">Data Partenza</label>
                            <input type="date" name="datapartenza" class="form-control" id="datapartenza" value="{{ old('datapartenza',$prenotation->GiornoPartenza) }}">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-12"><label for="nradulti" class="control-label">Nr. Adulti e Bambini</label></div>
                            <div class="col-sm-6">
                                <input type="text" name="nradulti" class="form-control" id="nradulti" value="{{ old('nradulti',$prenotation->NrAdulti) }}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="nrbambini" class="form-control" id="nrbambini" value="{{ old('nrbambini',$prenotation->NrBambini) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="note" class="control-label">Note</label>
                            <textarea name="note" id="note" class="form-control">{{ old('note',$prenotation->Note) }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="totale" class="control-label">Totale:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                                <input type="text" name="totale" id="totale" class="form-control" value="{{ old('totale', $prenotation->totale) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="acconto" class="control-label">Anticipo:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                                <input type="text" name="acconto" id="acconto" class="form-control" value="{{ old('acconto', $prenotation->acconto) }}">
                            </div>
                        </div>
                    </div>

                </div>

                @if($prenotation->exists)
                    <div class="form-group form-group-confirm clearfix">
                            <button class="btn btn-success" id="invia_conferma" type="button"{{ $prenotation->data_conferma_disp ? ' disabled' : '' }}>Invia Conferma Disponibilità
                                @if($prenotation->data_conferma_disp) (Inviata il {{  $prenotation->data_conferma_disp->format('d/m/Y H:i') }}) @endif</button>
                            <button class="btn btn-success" id="invia-camera-confermata" type="button"{{ $prenotation->data_conferma_prenotazione ? ' disabled' : '' }}>Invia E-Mail "Camera Confermata"
                                @if($prenotation->data_conferma_prenotazione) (Inviata il {{  $prenotation->data_conferma_prenotazione->format('d/m/Y H:i') }}) @endif</button>
                    </div>
                @endif


                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('prenotations') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>
        @if($prenotation->exists)

        <div class="panel panel-default" id="conferma" style="display: none;">
            <div class="panel-heading"><h3 class="panel-title">Conferma Disponibilità/Conferma Prenotazione</h3></div>
            <div class="panel-body">
                <form action>
                    <div class="form-group form-group-sm">
                        <label for="subject" class="control-label">Oggetto:</label>
                        <input type="text" name="subject" id="subject" class="form-control">
                        <input type="hidden" name="type" id="type">
                    </div>
                    <div class="form-group from-group-sm">
                        <label for="message" class="control-label">Contenuto del Messaggio:</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">

                        <button class="btn btn-primary" id="inviaConferma">Invia Conferma</button>

                    </div>

                </form>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Dati Pagamento</h3></div>
            <div class="panel-body">

                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="editPaymentData" id="editPaymentData"{{ old('editPaymentData') ? ' checked' : '' }}> Modifica Dati per il Pagamento</label>
                    </div>
                </div>

                <div class="row">
                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="totale" class="control-label">Totale Prenotazione:</label>
                            <input type="text" name="totale_prenotazione" id="totale_prenotazione" class="form-control" value="{{ old('totale_prenotazione', $prenotation->totale_prenotazione) }}">
                        </div>
                    </div>

                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="acconto_versato" class="control-label">Anticipo Ricevuto:</label>
                            <input type="text" name="acconto_versato" id="acconto_versato" class="form-control" value="{{ old('acconto_versato', $prenotation->acconto_versato) }}">
                        </div>
                    </div>

                    <div class="clearfix visible-md"></div>

                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="data_pagamento_acconto" class="control-label">Data Pagamento Anticipo:</label>
                            <input type="date" name="data_pagamento_acconto" id="data_pagamento_acconto" class="form-control" value="{{ old('data_pagamento_acconto',!$prenotation->data_pagamento_acconto ? null : $prenotation->data_pagamento_acconto->toDateString()) }}">
                        </div>
                    </div>

                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="stato_pagamento_acconto" class="control-label">Stato Pagamento Anticipo:</label>
                            <select id="stato_pagamento_acconto" class="form-control" name="stato_pagamento_acconto">
                                <option value="0"{{ old('stato_pagamento_acconto',$prenotation->stato_pagamento_acconto) == 0 ? ' selected' : '' }}>Nessun Pagamento Ricevuto</option>
                                <option value="1"{{ old('stato_pagamento_acconto',$prenotation->stato_pagamento_acconto) == 1 ? ' selected' : '' }}>Versato Acconto tramite PayPal</option>
                                <option value="2"{{ old('stato_pagamento_acconto',$prenotation->stato_pagamento_acconto) == 2 ? ' selected' : '' }}>Versato Acconto con Bonifico Bancario</option>
                                <option value="3"{{ old('stato_pagamento_acconto',$prenotation->stato_pagamento_acconto) == 3 ? ' selected' : '' }}>Saldato con PayPal</option>
                                <option value="4"{{ old('stato_pagamento_acconto',$prenotation->stato_pagamento_acconto) == 4 ? ' selected' : '' }}>Saldato con Bonifico Bancario</option>
                                <option value="5"{{ old('stato_pagamento_acconto',$prenotation->stato_pagamento_acconto) == 5 ? ' selected' : '' }}>Saldato in Contanti</option>

                            </select>
                        </div>
                    </div>

                    <div class="clearfix visible-md visible-lg"></div>

                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="rimanenza" class="control-label">Rimanenza:</label>
                            <input type="text" name="rimanenza" id="rimanenza" readonly="" class="form-control" value="">
                        </div>
                    </div>

                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="saldo_versato" class="control-label">Saldo Ricevuto:</label>
                            <input type="text" name="saldo_versato" id="saldo_versato" class="form-control" value="{{ old('saldo_versato', $prenotation->saldo_versato) }}">
                        </div>
                    </div>

                    <div class="clearfix visible-md"></div>

                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="data_pagamento_saldo" class="control-label">Data Pagamento Saldo:</label>
                            <input type="date" name="data_pagamento_saldo" id="data_pagamento_saldo" class="form-control" value="{{ old('data_pagamento_saldo',!$prenotation->data_pagamento_saldo ? null : $prenotation->data_pagamento_saldo->toDateString()) }}">
                        </div>
                    </div>

                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="stato_pagamento_saldo" class="control-label">Stato Pagamento Saldo:</label>
                            <select id="stato_pagamento_saldo" class="form-control" name="stato_pagamento_saldo">
                                <option value="0"{{ old('stato_pagamento_saldo', $prenotation->stato_pagamento_saldo) == 0 ? ' selected' : '' }}>Nessun Pagamento Ricevuto</option>
                                <option value="1"{{ old('stato_pagamento_saldo', $prenotation->stato_pagamento_saldo) == 1 ? ' selected' : '' }}>Versato Acconto tramite PayPal</option>
                                <option value="2"{{ old('stato_pagamento_saldo', $prenotation->stato_pagamento_saldo) == 2 ? ' selected' : '' }}>Versato Acconto con Bonifico Bancario</option>
                                <option value="3"{{ old('stato_pagamento_saldo', $prenotation->stato_pagamento_saldo) == 3 ? ' selected' : '' }}>Saldato con PayPal</option>
                                <option value="4"{{ old('stato_pagamento_saldo', $prenotation->stato_pagamento_saldo) == 4 ? ' selected' : '' }}>Saldato con Bonifico Bancario</option>
                                <option value="5"{{ old('stato_pagamento_saldo', $prenotation->stato_pagamento_saldo) == 5 ? ' selected' : '' }}>Saldato in Contanti</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearfix visible-md visible-lg"></div>

                    <div class="dati_pagamento col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="totale_versato" class="control-label">Totale Versato:</label>
                            <input type="text" readonly="" name="totale_versato" id="totale_versato" class="form-control" value="{{ old('totale_versato', $prenotation->totale_versato) }}">
                        </div>
                    </div>

                    <div class="clearfix visible-lg"></div>


                    <div class="dati_pagamento clearfix col-sm-12">
                        <div class="form-group">
                            <button class="btn btn-default" id="genera_fattura" type="button">Genera Fattura</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('prenotations') }}" class="btn btn-link">Torna Indietro</a>
                </div>

            </div>
        </div>


        @endif
    </form>

    <div class="modal fade" id="modal-id">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    Caricamento in corso...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary">Invia</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
@endsection

@section('bottom')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/jquery.tinymce.min.js"></script>

    <script>

        tinymce.init({
            selector: 'textarea#message',
            height: 250,
            theme: 'modern',
            //language_url: 'it',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            menubar: false
        });

        $(function() {

            $('select#idcliente').change(function(e) {

                var id = $(this).val();
                if(id && id > -1) {


                    $.getJSON('{{ route('prenotations.customer-data', null) }}/'+id, function(data) {

                        if(!$('input#nome').val()) $('input#nome').val(data.nome);
                        if(!$('input#cognome').val()) $('input#cognome').val(data.cognome);
                        if(!$('input#telefono').val()) $('input#telefono').val(data.telefono);
                        if(!$('input#email').val()) $('input#email').val(data.email);

                    });

                }

            }).change();
            $('input#editPaymentData').change(function(e) {
                $('div.dati_pagamento').find('input, select').prop('disabled', !$(this).is(':checked'));
            }).change();
            $('#totale').change(function() {

                $('#totale_prenotazione').val($(this).val()).change();

            });
            $('#totale_prenotazione').change(function() {

                var
                    totale = parseFloat($('#totale_prenotazione').val().toString().replace(',','.')),
                    versato = parseFloat($('#totale_versato').val().toString().replace(',','.')),
                    rimanenza = totale-versato;

                $('#rimanenza').val(rimanenza);



            }).change();
            $('#acconto_versato, #saldo_versato').change(function(e) {
                var
                    $totale = $('#totale_versato'),
                    $rimanenza = $('#rimanenza'),
                    totale = 0,
                    acconto = parseFloat($('#acconto_versato').val().toString().replace(',','.')),
                    saldo = parseFloat($('#saldo_versato').val().toString().replace(',','.'));

                if(!isNaN(acconto) && !isNaN(saldo))
                    totale = acconto + saldo;

                $totale.val(totale);

                $('#totale_prenotazione').change();

            }).change();

            $('button#invia_conferma').click(function(e) {
                e.preventDefault();

                var $conferma = $('div#conferma');

                $.getJSON('{{ route('prenotations.conferma-disp', $prenotation->id) }}').done(function(data) {

                    $conferma.show();
                    $conferma.find('#type').val('data_conferma_disp');
                    $conferma.find('.panel-title').text('Invia Conferma Disponibilità');
                    $conferma.find('#subject').val(data.subject);
                    $conferma.find('textarea').tinymce().setContent(data.html);

                });
            });

            $('button#invia-camera-confermata').click(function(e) {
                e.preventDefault();

                var $conferma = $('div#conferma');

                $.getJSON('{{ route('prenotations.conferma-prenotazione', $prenotation->id) }}').done(function(data) {

                    $conferma.show();
                    $conferma.find('#type').val('data_conferma_prenotazione');
                    $conferma.find('.panel-title').text('Invia Conferma Prenotazione');
                    $conferma.find('#subject').val(data.subject);
                    $conferma.find('textarea').tinymce().setContent(data.html);

                });

             });

            $('button#inviaConferma').click(function(e) {

                e.preventDefault();

                var $conferma = $('div#conferma'), data = {};

                $conferma.find('input').each(function(id, input) {
                    data[$(input).attr('name')] = $(input).val();
                });

                data['message'] = $conferma.find('textarea').tinymce().getContent();

                $.post('{{ route('prenotations.invia-conferma', $prenotation->id) }}', data, function(response) {

                    $conferma.hide();

                });


            });

        })

    </script>

@endsection
