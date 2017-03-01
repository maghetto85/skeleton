@extends('layouts.app')
@section('page.title','Clienti')
@section('head')
    
@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $guest->exists ? route('guests.update', $guest->id) : route('guests.store') }}">
        {{ csrf_field() }}
        @if($guest->exists)
            {{ method_field('put') }}
        @endif
        
        @if($errors->count())

            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <strong>Errore!</strong> Ci sono degli errori nel modulo!
            </div>
            
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">@if($guest->exists) Modifica Ospite @else Nuovo Ospite @endif</h3>
            </div>
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome" class="control-label">Nome:</label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome', $guest->nome) }}" class="form-control">
                            @if($errors->has('nome'))
                                <p class="help-block">
                                    {{ $errors->first('nome') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('cognome') ? ' has-error' : '' }}">
                            <label for="cognome" class="control-label">Cognome:</label>
                            <input type="text" id="cognome" name="cognome" value="{{ old('cognome', $guest->cognome) }}" class="form-control">
                            @if($errors->has('cognome'))
                                <p class="help-block">
                                    {{ $errors->first('cognome') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email:</label>
                            <input type="text" id="email" name="email" value="{{ old('email', $guest->email) }}" class="form-control">
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('cittadinanza') ? ' has-error' : '' }}">
                            <label for="cittadinanza" class="control-label">Cittadinanza:</label>
                            <input type="text" id="cittadinanza" name="cittadinanza" value="{{ old('cittadinanza', $guest->cittadinanza) }}" class="form-control">
                            @if($errors->has('cittadinanza'))
                                <p class="help-block">
                                    {{ $errors->first('cittadinanza') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('datanascita') ? ' has-error' : '' }}">
                            <label for="datanascita" class="control-label">Data di Nascita:</label>
                            <input type="date" id="datanascita" name="datanascita" value="{{ old('datanascita', !$guest->datanascita ? null : $guest->datanascita->toDateString()) }}" class="form-control">
                            @if($errors->has('datanascita'))
                                <p class="help-block">
                                    {{ $errors->first('datanascita') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('luogonascita') ? ' has-error' : '' }}">
                            <label for="luogonascita" class="control-label">Luogo di Nascita:</label>
                            <input type="text" id="luogonascita" name="luogonascita" value="{{ old('luogonascita', $guest->luogonascita) }}" class="form-control">
                            @if($errors->has('luogonascita'))
                                <p class="help-block">
                                    {{ $errors->first('luogonascita') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('tipodocumento') ? ' has-error' : '' }}">
                            <label for="tipodocumento" class="control-label">Tipo Documento:</label>
                            <input type="text" id="tipodocumento" name="tipodocumento" value="{{ old('tipodocumento', $guest->tipodocumento) }}" class="form-control">
                            @if($errors->has('tipodocumento'))
                                <p class="help-block">
                                    {{ $errors->first('tipodocumento') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('nrdocumento') ? ' has-error' : '' }}">
                            <label for="nrdocumento" class="control-label">Numero Documento:</label>
                            <input type="text" id="nrdocumento" name="nrdocumento" value="{{ old('nrdocumento', $guest->nrdocumento) }}" class="form-control">
                            @if($errors->has('nrdocumento'))
                                <p class="help-block">
                                    {{ $errors->first('nrdocumento') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('datarilascio') ? ' has-error' : '' }}">
                            <label for="datarilascio" class="control-label">Data Rilascio Documento:</label>
                            <input type="date" id="datarilascio" name="datarilascio" value="{{ old('datarilascio', !$guest->datarilascio ? null : $guest->datarilascio->toDateString()) }}" class="form-control">
                            @if($errors->has('datarilascio'))
                                <p class="help-block">
                                    {{ $errors->first('datarilascio') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('luogorilascio') ? ' has-error' : '' }}">
                            <label for="luogorilascio" class="control-label">Luogo Rilascio Documento:</label>
                            <input type="text" id="luogorilascio" name="luogorilascio" value="{{ old('luogorilascio', $guest->luogorilascio) }}" class="form-control">
                            @if($errors->has('luogorilascio'))
                                <p class="help-block">
                                    {{ $errors->first('luogorilascio') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('datascadenza') ? ' has-error' : '' }}">
                            <label for="datascadenza" class="control-label">Data Scadenza Documento:</label>
                            <input type="date" id="datascadenza" name="datascadenza" value="{{ old('datascadenza', !$guest->datascadenza ? null : $guest->datascadenza->toDateString()) }}" class="form-control">
                            @if($errors->has('datascadenza'))
                                <p class="help-block">
                                    {{ $errors->first('datascadenza') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('guests') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>

    </form>
    

</div>
@endsection

@section('bottom')
    

@endsection
