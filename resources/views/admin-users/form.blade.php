@extends('layouts.app')
@section('page.title','Utenti Pannello di Controllo')
@section('head')

@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $adminuser->exists ? route('admin-users.update', $adminuser->IdUtente) : route('admin-users.store') }}">
        {{ csrf_field() }}
        @if($adminuser->exists)
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
                <h3 class="panel-title">@if($adminuser->exists) Modifica Utente @else Nuovo Utente @endif</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('Nome') ? ' has-error' : '' }}">
                            <label for="Nome" class="control-label">Nome:</label>
                            <input type="text" id="Nome" name="Nome" value="{{ old('Nome', $adminuser->Nome) }}" class="form-control">
                            @if($errors->has('Nome'))
                            <p class="help-block">
                                {{ $errors->first('Nome') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Indirizzo E-Mail:</label>
                            <input type="text" id="email" name="email" value="{{ old('email', $adminuser->email) }}" class="form-control">
                            @if($errors->has('email'))
                            <p class="help-block">
                                {{ $errors->first('email') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('NomeUtente') ? ' has-error' : '' }}">
                            <label for="NomeUtente" class="control-label">Nome Utente:</label>
                            <input type="text" id="NomeUtente" name="NomeUtente" value="{{ old('NomeUtente', $adminuser->NomeUtente) }}" class="form-control">
                            @if($errors->has('NomeUtente'))
                            <p class="help-block">
                                {{ $errors->first('NomeUtente') }}
                            </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password:</label>
                            <input type="text" id="password" name="password" value="" class="form-control">
                            @if($errors->has('password'))
                            <p class="help-block">
                                {{ $errors->first('password') }}
                            </p>
                            @endif
                        </div>
                    </div>


                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('admin-users') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('bottom')

@endsection
