@extends('layouts.app')
@section('page.title','Clienti')
@section('page.navbar')
    @if(request('filtered'))
        <li><a href="{{ URL::current() }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Clienti</a></li>
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
        <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm">Nuovo Cliente</a>
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
                    <th class="text-right">ID</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td class="text-center success">
                        <a href="{{ route('customers.edit', $customer->id) }}"><i class="fa fa-fw fa-pencil"></i></a>
                    </td>
                    <td class="text-center danger">
                        <a href="#elimina" data-toggle="modal" data-id="{{ $customer->id }}" data-name="{{ $customer->titolo }}"><i class="fa fa-fw fa-remove"></i></a>
                    </td>
                    <td>{{ ucfirst(strtolower($customer->nome)) }}</td>
                    <td>{{ ucfirst(strtolower($customer->cognome)) }}</td>
                    <td{!! !$customer->email ? ' class="text-danger"' : '' !!}>{{ !$customer->email ? 'Non Specificata' : $customer->email }}</td>
                    <th class="text-right">{{$customer->id}}</th>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="10">Nessun Cliente Trovato</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $customers->render() }}

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
            modal.find('form').attr('action','{{ route('customers.destroy',null) }}/'+id);
            modal.find('.modal-body #modal-name').text(nome);
        })

    </script>

@endsection
