@extends('layouts.app')
@section('page.title','Menu Orizzontale')
@section('page.navbar')
    @if(request('filtered'))
        <li><a href="{{ URL::current() }}"><i class="fa fa-chevron-left fa-fw"></i> Menu</a></li>
    @endif
@endsection
@section('content')
<div class="container">

     <div style="margin-bottom: 20px;">
        <div class="pull-right">
            <form class="form-inline">
                <div class="form-group form-group-sm">

                    <select name="lang" id="lang" class="form-control selectpicker" title="Lingua">
                        <option value="">Tutte</option>
                        @foreach(\App\Locale::orderBy('name')->get() as $locale)
                            <option data-content="<img src=&quot;{{ $locale->flag}}&quot; alt=&quot;&quot; style=&quot;height: 16px; vertical-align: middle;&quot;> {{ $locale->name}}  " value="{{ $locale->code }}"{{ $locale->code == request('lang') ? ' selected' : '' }}>{{ $locale->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group form-group-sm">
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
        <a href="{{ route('menu.create') }}" class="btn btn-primary btn-sm">Nuovo Elemento</a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@yield('page.title')</h3>
        </div>
        @include('menu.list')
    </div>

    {{ $menus->render() }}

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
            modal.find('form').attr('action','{{ route('menu.destroy',null) }}/'+id);
            modal.find('.modal-body #modal-name').text(nome);
        });

        $('div#menus-list').on('click', '.btnMoveUp, .btnMoveDown', function(e) {

            var $this = $(this), $row = $this.parents('tr').first(), id = $row.attr('data-id'), pos = parseInt($row.attr('data-position'));

            if ($this.is('.btnMoveUp')) pos--; else pos++;

            $.post('{{ route('menu.move', [null]) }}/' + id, {position: pos}, function () {

                $row.attr('data-position', pos);
                if ($this.is('.btnMoveUp')) {
                    $row.insertBefore($row.prev());
                } else {
                    $row.insertAfter($row.next());
                }

                $('div#menus-list').find('tr').each(function (id, li) {
                    $(li).find('button.btnMoveUp').prop('disabled', $(li).is(':first-child'));
                    $(li).find('button.btnMoveDown').prop('disabled', $(li).is(':last-child'));
                })

            });
        });




    </script>

@endsection
