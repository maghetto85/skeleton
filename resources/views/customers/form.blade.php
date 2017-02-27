@extends('layouts.app')
@section('page.title','Clienti')
@section('head')
    
@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $customer->exists ? route('customers.update', $customer->id) : route('customers.store') }}">
        {{ csrf_field() }}
        @if($customer->exists)
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
                <h3 class="panel-title">@if($customer->exists) Modifica Cliente @else Nuovo Cliente @endif</h3>
            </div>
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome" class="control-label">Nome:</label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome', $customer->nome) }}" class="form-control">
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
                            <input type="text" id="cognome" name="cognome" value="{{ old('cognome', $customer->cognome) }}" class="form-control">
                            @if($errors->has('cognome'))
                                <p class="help-block">
                                    {{ $errors->first('cognome') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="control-label">Telefono:</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $customer->telefono) }}" class="form-control">
                            @if($errors->has('telefono'))
                                <p class="help-block">
                                    {{ $errors->first('telefono') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email:</label>
                            <input type="text" id="email" name="email" value="{{ old('email', $customer->email) }}" class="form-control">
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                    </div>

                </div>
                
                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('indirizzo') ? ' has-error' : '' }}">
                            <label for="indirizzo" class="control-label">Indirizzo:</label>
                            <input type="text" id="indirizzo" name="indirizzo" value="{{ old('indirizzo', $customer->indirizzo) }}" class="form-control">
                            @if($errors->has('indirizzo'))
                                <p class="help-block">
                                    {{ $errors->first('indirizzo') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('cap') ? ' has-error' : '' }}">
                            <label for="cap" class="control-label">Cap:</label>
                            <input type="text" id="cap" name="cap" value="{{ old('cap', $customer->cap) }}" class="form-control">
                            @if($errors->has('cap'))
                                <p class="help-block">
                                    {{ $errors->first('cap') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('citta') ? ' has-error' : '' }}">
                            <label for="citta" class="control-label">Citta:</label>
                            <input type="text" id="citta" name="citta" value="{{ old('citta', $customer->citta) }}" class="form-control">
                            @if($errors->has('citta'))
                                <p class="help-block">
                                    {{ $errors->first('citta') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('provincia') ? ' has-error' : '' }}">
                            <label for="provincia" class="control-label">Provincia:</label>
                            <input type="text" id="provincia" name="provincia" value="{{ old('provincia', $customer->provincia) }}" class="form-control">
                            @if($errors->has('provincia'))
                                <p class="help-block">
                                    {{ $errors->first('provincia') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('codicefiscale') ? ' has-error' : '' }}">
                            <label for="codicefiscale" class="control-label">Codice Fiscale:</label>
                            <input type="text" id="codicefiscale" name="codicefiscale" value="{{ old('codicefiscale', $customer->codicefiscale) }}" class="form-control">
                            @if($errors->has('codicefiscale'))
                                <p class="help-block">
                                    {{ $errors->first('codicefiscale') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('partitaiva') ? ' has-error' : '' }}">
                            <label for="partitaiva" class="control-label">Partita Iva:</label>
                            <input type="text" id="partitaiva" name="partitaiva" value="{{ old('partitaiva', $customer->partitaiva) }}" class="form-control">
                            @if($errors->has('partitaiva'))
                                <p class="help-block">
                                    {{ $errors->first('partitaiva') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('customers') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>

    </form>
    

</div>
@endsection

@section('bottom')
    

@endsection
