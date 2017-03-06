@extends('layouts.app')
@section('page.title', ($menu->exists ? $menu->titolo : 'Nuovo Elemento') )
@section('page.navbar')
    <li><a href="{{ route('menu.index') }}"><i class="fa fa-chevron-left fa-fw"></i> Menu</a></li>
@endsection
@section('head')
    
@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $menu->exists ? route('menu.update', $menu->id) : route('menu.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="parent" value="{{ $menu->parent }}">
        @if($menu->exists)
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
                <h3 class="panel-title">@if($menu->exists) Modifica Elemento @else Nuovo Elemento @endif</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('lang') ? ' has-error' : '' }}">
                            <label for="lang" class="control-label">Lingua:</label>
                            <select name="lang" id="lang" class="form-control selectpicker">
                                @foreach(\App\Locale::orderBy('name')->get() as $locale)
                                    <option data-content="<img src=&quot;{{ $locale->flag}}&quot; alt=&quot;&quot; style=&quot;height: 16px; vertical-align: middle;&quot;> {{ $locale->name}}  " value="{{ $locale->code }}"{{ $locale->code == old('lang',$menu->lang) ? ' selected' : '' }}>{{ $locale->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('Lang'))
                                <p class="help-block">
                                    {{ $errors->first('lang') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-9">
                        <div class="form-group form-group-sm{{ $errors->has('titolo') ? ' has-error' : '' }}">
                            <label for="titolo" class="control-label">Titolo:</label>
                            <input type="text" id="titolo" name="titolo" value="{{ old('titolo', $menu->titolo) }}" class="form-control">
                            @if($errors->has('titolo'))
                                <p class="help-block">
                                    {{ $errors->first('titolo') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>


                

                
                <div class="form-group form-group-sm{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url" class="control-label">Destinazione:</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">
                            http://www.halex.it/
                        </span>
                        <input type="text" id="url" name="url" value="{{ old('url', $menu->url) }}" class="form-control">
                    </div>

                    @if($errors->has('url'))
                        <p class="help-block">
                            {{ $errors->first('url') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('menu') }}{{ $menu->parent ? '/'.$menu->parent : '' }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>

    </form>

    @if($menu->exists)

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Sottomenu di {{ $menu->titolo }}</h3></div>
        @include('menu.list',['menus' => $menus])
        <div class="panel-body">
            <a href="{{ route('menu.create',['lang' => $menu->lang, 'parent' => $menu->id]) }}" class="btn btn-primary">Nuovo</a>
        </div>
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
        
    @endif
    

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
        })

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
