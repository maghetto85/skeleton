@extends('layouts.app')
@section('page.title','Ospiti')
@section('page.navbar')
    @if(request('filtered'))
        <li><a href="{{ URL::current() }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Ospiti</a></li>
    @endif
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
                            @if(request('filtered'))
                            <a href="{{ URL::current() }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                            @endif
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <a href="{{ route('guests.create') }}" class="btn btn-primary btn-sm">Nuovo Ospite</a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@yield('page.title')</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th style="width: 24px;"></th>
                    <th style="width: 24px;"></th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th>Nazionalità</th>
                    <th class="text-right">ID</th>
                </tr>
                </thead>
                <tbody>
                @forelse($guests as $guest)
                <tr>
                    <td class="text-center success">
                        <a href="{{ route('guests.edit', $guest->id) }}"><i class="fa fa-fw fa-pencil"></i></a>
                    </td>
                    <td class="text-center danger">
                        <a href="#elimina" data-toggle="modal" data-id="{{ $guest->id }}" data-name="{{ $guest->titolo }}"><i class="fa fa-fw fa-remove"></i></a>
                    </td>
                    <td>{{ ucfirst(strtolower($guest->nome)) }}</td>
                    <td>{{ ucfirst(strtolower($guest->cognome)) }}</td>
                    <td{!! !$guest->email ? ' class="text-danger"' : '' !!}>{{ !$guest->email ? 'Non Specificata' : $guest->email }}</td>
                    <td>{{ $guest->cittadinanza }}</td>
                    <th class="text-right">{{$guest->id}}</th>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="10">Nessun Ospite Trovato</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $guests->render() }}

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
            modal.find('form').attr('action','{{ route('guests.destroy',null) }}/'+id);
            modal.find('.modal-body #modal-name').text(nome);
        })

    </script>

@endsection
