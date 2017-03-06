@extends('layouts.app')
@section('page.title',"Traduzioni {$locale->code}")
@section('page.navbar')
    <li><a href="{{ route('locales.index') }}"><i class="fa fa-fw fa-chevron-left"></i> Lingue</a></li>
@endsection
@section('head')

@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ route('locales.translation', $locale->code)  }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        @if($errors->count())

            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <strong>Errore!</strong> Ci sono degli errori nel modulo!
            </div>
            
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Modifica Traduzioni</h3>
            </div>

            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th class="text-right col-sm-6">Testo Originale</th>
                    <th>Testo Tradotto</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $valore)
                <tr>
                    <td class="text-right" style="vertical-align: middle;"><label for="{{ $key }}" class="control-label" style="margin: 0;">{{ $key }}:</label></td>
                    <td><input type="text" name="{{ $key }}[value]" id="{{ $key }}" value="{{ $valore }}" class="form-control input-sm">
                        <input type="hidden" name="{{ $key }}[key]" value="{{$key}}">
                    </td>
                </tr>
                @endforeach
                </tbody>

            </table>


            <div class="panel-body">

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
