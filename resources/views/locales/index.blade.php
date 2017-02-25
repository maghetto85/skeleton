@extends('layouts.app')
@section('page.title','Gestione Lingue')
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
        <a href="{{ route('locales.create') }}" class="btn btn-primary btn-sm">Nuova Lingua</a>
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
                    <th>Codice</th>
                    <th>Bandiera</th>
                </tr>
                </thead>
                <tbody>
                @forelse($locales as $locale)
                <tr>
                    <td class="text-center success">
                        <a href="{{ route('locales.edit', $locale->id) }}"><i class="fa fa-fw fa-pencil"></i></a>
                    </td>
                    <td class="text-center danger">
                        <a href="#elimina" data-toggle="modal" data-id="{{ $locale->id }}" data-name="{{ $locale->name }}"><i class="fa fa-fw fa-remove"></i></a>
                    </td>
                    <td>{{ $locale->name }}</td>
                    <td>{{ $locale->code }}</td>
                    <td><img src="{{ $locale->flag }}" alt=""></td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="10">Nessun Elemento Trovato</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $locales->render() }}

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
            modal.find('form').attr('action','{{ route('locales.destroy',null) }}/'+id);
            modal.find('.modal-body #modal-name').text(nome);
        })

    </script>

@endsection
