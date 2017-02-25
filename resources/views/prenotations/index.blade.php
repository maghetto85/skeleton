<?php /** @var App\Prenotation $prenotation */ ?>
@extends('layouts.app')
@section('page.title','Prenotazioni')
@section('page.navbar')
    @if(request('filtered'))
        <li><a href="{{ URL::current() }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Prenotazioni</a></li>
    @endif
@endsection
@section('content')
<div class="container">

    <div style="margin-bottom: 20px; overflow: hidden;">
        <div class="pull-left" style="margin-bottom: 10px;">
            <a href="{{ route('prenotations.create') }}" class="btn btn-primary btn-sm">Nuova Prenotazione</a>
        </div>
        <div class="pull-right">
            <form class="form-inline" method="get">
                <div class="form-group form-group-sm">
                    <label for="DataArrivo" class="visible-xs visible-sm control-label">Arrivo:</label>
                    <input type="date" class="form-control" name="DataArrivo" id="DataArrivo" value="{{ request('DataArrivo') }}">
                </div>
                <div class="form-group form-group-sm">
                    <label for="DataPartenza" class="visible-xs visible-sm control-label">Partenza:</label>
                    <input type="date" class="form-control" name="DataPartenza" id="DataPartenza" value="{{ request('DataPartenza') }}">
                </div>
                <div class="form-group form-group-sm">
                    <label class="visible-xs visible-sm control-label">Stato:</label>
                    <select name="stato" id="stato" class="form-control" title="Stato Prenotazione">
                        <option value="">Tutte</option>
                        <option value="0"{{ old('stato',request('stato')) == "0" ? ' selected' : '' }}>Da Confermare</option>
                        <option value="1"{{ old('stato',request('stato')) == 1 ? ' selected' : '' }}>Confermate</option>
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label class="visible-xs visible-sm control-label">Camera:</label>
                    <select name="room_id" id="room_id" class="form-control" title="Camera">
                        <option value="0">Tutte le camere</option>
                        @foreach(\App\Room::orderBy('titolo')->get() as $room)
                            <option value="{{ $room->id }}"{{ old('room_id',request('room_id')) == $room->id ? ' selected' : '' }}>{{ $room->titolo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label class="visible-xs visible-sm control-label">Origine:</label>
                    <select name="origine" id="origine" class="form-control" title="Origine della Prenotazione">
                        <option value="">Tutte</option>
                        <option value="0"{{ old('origine',request('origine')) == "0" ? ' selected' : '' }}>Pannello</option>
                        <option value="1"{{ old('origine',request('origine')) == 1 ? ' selected' : '' }}>Modulo</option>
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label class="visible-xs visible-sm control-label">Cerca:</label>
                    <div class="input-group input-group-sm">
                        <input type="text" name="q" id="q" class="form-control" placeholder="Cerca" value="{{ request('q') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><i class="fa fa-search"></i></button>
                            @if(request('filtered'))
                                <a href="{{ URL::current() }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                            @endif
                        </span>
                    </div>
                </div>
                <br>
                <div class="checkbox">
                    <label><input type="checkbox" name="showOld" value="1"{{ request('showOld') ? ' checked' : '' }}> Mostra Prenotazioni archiviate</label>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $prenotations->total() }} @yield('page.title') @if(request('filtered')) Trovate @endif - Pagina {{ $prenotations->currentPage() }} di {{ $prenotations->lastPage() }}</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th style="width: 24px;"></th>
                    <th style="width: 24px;"></th>
                    <th colspan="2">Periodo</th>
                    <th>Stato</th>
                    <th>Camera</th>
                    <th>Cliente</th>
                    <th>E-Mail</th>
                    <th title="Adulti">A</th>
                    <th title="Bambini">B</th>
                    <th>Data Inserimento</th>
                    <th class="text-right">ID</th>
                </tr>
                </thead>
                <tbody>
                @forelse($prenotations as $prenotation)
                <tr>
                    <td class="text-center success">
                        <a href="{{ route('prenotations.edit', $prenotation->id) }}"><i class="fa fa-fw fa-pencil"></i></a>
                    </td>
                    <td class="text-center danger">
                        <a href="#elimina" data-toggle="modal" data-id="{{ $prenotation->id }}" data-name="{{ $prenotation->titolo }}"><i class="fa fa-fw fa-remove"></i></a>
                    </td>
                    <td class="text-right">{{ $prenotation->DataArrivo }}</td>
                    <td>{{ $prenotation->DataPartenza }}</td>
                    <td>
                        <span title="{{ $prenotation->status->name }}" class="{{ $prenotation->status->class }}" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle;"></span>
                        <span class="hidden-xs hidden-sm">{{ $prenotation->status->name }}</span>
                    </td>
                    <td>{{ $prenotation->room->titolo }}</td>
                    <td>{{ $prenotation->Nome }} {{ $prenotation->Cognome }}</td>
                    <td{!! $prenotation->Email == '' ? ' class="text-danger"' : '' !!}>{{ $prenotation->Email ? $prenotation->Email : 'Non Specificata' }}</td>
                    <td>{{ $prenotation->NrAdulti }}</td>
                    <td>{{ $prenotation->NrBambini }}</td>
                    <td>{{ $prenotation->DataInserimento }}</td>
                    <th class="text-right">{{ $prenotation->id }}</th>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="12">Nessuna Prenotazione Trovata</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $prenotations->render() }}

    <div class="modal fade" id="elimina">
        <form action="" method="post">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Conferma Eliminazione</h4>
                    </div>
                    <div class="modal-body">
                        Confermi la Rimozione?

                        <h4 class="text-danger" id="modal-name"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->

</div>
@endsection

@section('bottom')

    <script>

        $('#elimina').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id'), nome = button.data('name');
            var modal = $(this)
            modal.find('form').attr('action','{{ route('prenotations.destroy',null) }}/'+id);
            modal.find('.modal-body #modal-name').text(nome);
        })

    </script>

@endsection
