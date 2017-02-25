<?php /** @var App\Prenotation $invoice */ ?>
@extends('layouts.app')
@section('page.title','Fatture')
@section('page.navbar')
    @if(request('filtered'))
        <li><a href="{{ URL::current() }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Fatture</a></li>
    @endif
@endsection
@section('content')
<div class="container">

    <div style="margin-bottom: 20px; overflow: hidden;">
        <div class="pull-left" style="margin-bottom: 10px;">
            <a href="{{ route('invoices.create') }}" class="btn btn-primary btn-sm">Nuova Fattura</a>
        </div>
        <div class="pull-right">
            <form class="form-inline" method="get">
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
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $invoices->total() }} @yield('page.title') @if(request('filtered')) Trovate @endif - Pagina {{ $invoices->currentPage() }} di {{ $invoices->lastPage() }}</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th style="width: 24px;"></th>
                    <th style="width: 24px;"></th>
                    <th>Nr.</th>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th class="text-right">Prezzo</th>
                    <th class="text-right">ID</th>
                </tr>
                </thead>
                <tbody>
                @forelse($invoices as $invoice)
                <tr>
                    <td class="text-center success"><a href="{{ route('invoices.edit', $invoice->id) }}"><i class="fa fa-fw fa-pencil"></i></a></td>
                    <td class="text-center danger"><a href="#elimina" data-toggle="modal" data-id="{{ $invoice->id }}" data-name="{{ $invoice->titolo }}"><i class="fa fa-fw fa-remove"></i></a></td>
                    <td>{{ $invoice->numero }} / {{ $invoice->data->format('Y') }}</td>
                    <td>{{ $invoice->data->format('d/m/Y') }}</td>
                    <td>{{ $invoice->Nome }}</td>
                    <td class="text-right">{{ number_format($invoice->totalefattura,2,',','.') }} &euro;</td>
                    <th class="text-right">{{ $invoice->id }}</th>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="12">Nessuna Fattura Trovata</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $invoices->render() }}

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
            modal.find('form').attr('action','{{ route('invoices.destroy',null) }}/'+id);
            modal.find('.modal-body #modal-name').text(nome);
        })

    </script>

@endsection
