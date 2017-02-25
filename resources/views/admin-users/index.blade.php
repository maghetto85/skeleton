@extends('layouts.app')
@section('page.title','Utenti Pannello di Controllo')
@section('head')

@endsection
@section('content')
<div class="container">

     <div style="margin-bottom: 20px;">
        <div class="pull-right">
            <form class="form-inline">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <input type="text" name="q" id="q" class="form-control" placeholder="Cerca" value="{{ request('q') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <a href="{{ route('admin-users.create') }}" class="btn btn-primary btn-sm">Nuovo Utente</a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Utenti Pannello di Controllo</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th style="width: 24px;"></th>
                    <th style="width: 24px;"></th>
                    <th>Nome Utente</th>
                    <th>Nome</th>
                    <th>Indirizzo E-Mail</th>
                    <th class="text-right">Ultimo Accesso</th>
                </tr>
                </thead>
                <tbody>
                @forelse($adminusers as $adminuser)
                <tr>
                    <td class="text-center success">
                        <a href="{{ route('admin-users.edit', $adminuser->IdUtente) }}"><i class="fa fa-fw fa-pencil"></i></a>
                    </td>
                    <td class="text-center danger">
                        <a href="#elimina" data-toggle="modal" data-id="{{ $adminuser->IdUtente }}" data-name="{{ $adminuser->Nome }}"><i class="fa fa-fw fa-remove"></i></a>
                    </td>
                    <td>{{ $adminuser->NomeUtente }}</td>
                    <td>{{ $adminuser->Nome }}</td>
                    <td>{{ $adminuser->email }}</td>
                    <td class="text-right">{{ $adminuser->DataUltimoAccesso ? $adminuser->DataUltimoAccesso->format('d/m/Y H:i:s') : '' }}</td>

                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="10">Nessun Utente Trovato</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $adminusers->render() }}

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
            modal.find('form').attr('action','{{ route('admin-users.destroy',null) }}/'+id);
            modal.find('.modal-body #modal-name').text(nome);
        })

    </script>

@endsection
