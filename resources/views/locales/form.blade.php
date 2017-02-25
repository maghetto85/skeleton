@extends('layouts.app')
@section('page.title','Gestione Lingue')
@section('head')

@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $locale->exists ? route('locales.update', $locale->id) : route('locales.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if($locale->exists)
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
                <h3 class="panel-title">@if($locale->exists) Modifica Elemento @else Nuovo Elemento @endif</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group form-group-sm{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Nome:</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $locale->name) }}" class="form-control">
                            @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="control-label">Codice:</label>
                            <input type="text" id="code" name="code" value="{{ old('code', $locale->code) }}" class="form-control">
                            @if($errors->has('code'))
                            <p class="help-block">
                                {{ $errors->first('code') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group form-group-sm">
                            <label for="flag" class="control-label">Bandiera:</label>
                            <div style="margin-bottom: 10px;">
                                <img src="{{ $locale->flag }}" alt="" style="display: block">
                            </div>

                            <input type="file" name="flag" id="">

                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('locales') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('bottom')

@endsection
