@extends('layouts.app')
@section('page.title','Menu Pannello di Controllo')
@section('head')

@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $adminmenu->exists ? route('admin-menu.update', $adminmenu->id) : route('admin-menu.store') }}">
        {{ csrf_field() }}
        @if($adminmenu->exists)
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
                <h3 class="panel-title">@if($adminmenu->exists) Modifica Elemento @else Nuovo Elemento @endif</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('titolo') ? ' has-error' : '' }}">
                            <label for="titolo" class="control-label">Titolo:</label>
                            <input type="text" id="titolo" name="titolo" value="{{ old('titolo', $adminmenu->titolo) }}" class="form-control">
                            @if($errors->has('titolo'))
                            <p class="help-block">
                                {{ $errors->first('titolo') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group form-group-sm{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="control-label">Url:</label>
                            <input type="text" id="url" name="url" value="{{ old('url', $adminmenu->url) }}" class="form-control">
                            @if($errors->has('url'))
                            <p class="help-block">
                                {{ $errors->first('url') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-sm">
                            <label for="visibile" class="control-label">Visibile:</label>
                            <select name="visibile" id="visibile" class="form-control">
                                <option value=""></option>
                                <option value="1"{{ old('visibile',$adminmenu->visibile) == 1 ? ' selected' :'' }}>Si</option>
                                <option value="0"{{ old('visibile',$adminmenu->visibile) == 0 ? ' selected' :'' }}>No</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('admin-menu') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('bottom')

@endsection
