@extends('layouts.app')
@section('page.title', ( ($page->exists ? $page->titolo : 'Nuova Pagina') .' - Pagine') )
@section('page.navbar')
    <li><a href="{{ route('pagesc.index') }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Pagine</a></li>
@endsection
@section('head')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plupload/2.2.1/jquery.plupload.queue/css/jquery.plupload.queue.css" />
    <style>

        ul#images {
            list-style: none;
            margin: 0 -15px;
            margin-bottom: 20px;
            padding: 0;
            overflow: hidden;
            overflow-y: auto;
            height: 350px;
        }

        div#editor img {
            display: block;
            max-width: 100%;
            max-height: 150px;
            margin-bottom: 10px;
        }

    </style>
@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $page->exists ? route('pagesc.update', $page->id) : route('pagesc.store') }}">
        {{ csrf_field() }}
        @if($page->exists)
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
                <h3 class="panel-title">@if($page->exists) Modifica Pagina @else Nuova Pagina @endif</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group form-group-sm{{ $errors->has('lang') ? ' has-error' : '' }}">
                            <label for="lang" class="control-label">Lingua:</label>
                            <select name="lang" id="lang" class="form-control selectpicker">
                                @foreach(\App\Locale::orderBy('name')->get() as $locale)
                                    <option data-content="<img src=&quot;{{ $locale->flag}}&quot; alt=&quot;&quot; style=&quot;height: 16px; vertical-align: middle;&quot;> {{ $locale->name}}  " value="{{ $locale->code }}"{{ $locale->code == old('lang',$page->lang) ? ' selected' : '' }}>{{ $locale->name }}</option>
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
                            <input type="text" id="titolo" name="titolo" value="{{ old('titolo', $page->titolo) }}" class="form-control">
                            @if($errors->has('titolo'))
                                <p class="help-block">
                                    {{ $errors->first('titolo') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>


                

                
                <div class="form-group form-group-sm{{ $errors->has('slug') ? ' has-error' : '' }}">
                    <label for="slug" class="control-label">Slug:</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">
                            http://www.halex.it/
                        </span>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" class="form-control">
                    </div>

                    @if($errors->has('slug'))
                        <p class="help-block">
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('pagesc') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>

    </form>

    @if($page->exists)

    <div class="panel panel-default" id="lista-paragrafi">
        <div class="panel-heading"><h3 class="panel-title">Paragrafi</h3></div>
        <table class="table table-condensed table-bordered" id="paragrafi">
            @foreach($page->paragraphs()->orderBy('posizione')->get() as $paragraph)
                <tr data-id="{{ $paragraph->id }}" data-position="{{ $paragraph->posizione }}" data-name="{{ $paragraph->titolo }}">
                    <td class="text-center success" style="width: 24px;">
                        <button href="#" class="btn btn-xs btn-success btnEdit"><i class="fa fa-fw fa-pencil"></i></button>
                    </td>
                    <td class="text-center warning" style="width: 24px;">
                        <button {{ $loop->first ? 'disabled ' : '' }}class="btn btn-xs btn-default btnMoveUp"><i class="fa fa-fw fa-chevron-up"></i></button>
                    </td>
                    <td class="text-center warning" style="width: 24px;">
                        <button {{ $loop->last ? 'disabled ' : '' }}class="btn btn-xs btn-default btnMoveDown"><i class="fa fa-fw fa-chevron-down"></i></button>
                    </td>
                    <td class="text-center danger" style="width: 24px;">
                        <button href="#" class="btn btn-xs btn-danger btnRemove"><i class="fa fa-fw fa-remove"></i></button>
                    </td>
                    <td>{{$paragraph->titolo }}</td>
                </tr>
            @endforeach
        </table>
        <div class="panel-body">

            <button class="btn btn-primary btnNuovoParagrafo">Nuovo Paragrafo</button>
            <a href="{{ url('pagesc') }}" class="btn btn-link">Torna Indietro</a>

        </div>
    </div>

    <form>
        <div class="panel panel-default" id="editor" style="display: none;">
            <div class="panel-heading"><h3 class="panel-title">Nuovo Paragrafo - Modifica Paragrafo</h3></div>
            <div class="panel-body">

                <div class="form-group form-group-sm">
                    <label for="titolo" class="control-label">Titolo:</label>
                    <input type="text" id="titolo" name="titolo" value="" class="form-control">
                </div>

                <div class="form-group form-group-sm">
                    <label for="foto" class="control-label">Immagine:</label>
                    <div style="clear: both; overflow: hidden;">

                        <img src="" alt="">
                        <input type="hidden" name="foto">

                        <div class="pull-left">
                            <button class="btn btn-primary btnCambiaImmagine">Cambia Immagine</button>
                        </div>
                    </div>

                </div>

                <div class="form-group form-group-sm">
                    <label for="descrizione" class="control-label">Contenuto:</label>
                    <textarea id="descrizione" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="idpagina" value="{{ $page->id }}">
                    <button class="btn btnSalva btn-primary">Salva Paragrafo</button>
                    <button class="btn btnListaParagrafi btn-success"><i class="fa fa-chevron-left"></i> Lista Paragrafi</button>
                </div>

            </div>
        </div>
    </form>

    @endif

    <div class="modal fade" id="elimina">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Conferma Eliminazione</h4>
                </div>
                <div class="modal-body">
                    Confermi la Rimozione del Paragrafo Selezionato?

                    <h4 class="text-danger" id="modal-name"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-danger btn-conferma">Elimina</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('bottom')

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/jquery.tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/2.2.1/plupload.full.min.js"></script>
    <script>

        tinymce.init({
            selector: 'textarea',
            height: 250,
            theme: 'modern',
            //language_url: 'it',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            menubar: false
        });

        $(function() {

            var
                $editor = $('div#editor'),
                $listaParagrafi = $('div#lista-paragrafi'),
                $pulsante = $editor.find('.btnCambiaImmagine'),
                $paragrafi = $('table#paragrafi'),
                uploader = new plupload.Uploader({
                    browse_button: $pulsante[0],
                    url: '{{ route('paragraphs.upload') }}',
                    multipart_params: {
                        _token: Laravel.csrfToken
                    }
                });

            uploader.init();

            uploader.bind('QueueChanged', function() {
                uploader.start();
                $pulsante.prop('disabled',true);
            });

            uploader.bind('UploadProgress', function(up, file) {
                $pulsante.html('Caricamento in corso... ' + file.percent + "%");
            });

            uploader.bind('fileUploaded', function(uploader, file, response) {

                var url = JSON.parse(response.response)['url'] || '';

                $editor.find('img').attr('src','http://www.halex.it'+url);
                
                $editor.find('input[name=foto]').val(url);
                $pulsante.prop('disabled',false).text('Cambia Immagine');
            });


            $paragrafi
                .on('click', '.btnEdit', function(e) {

                var $this = $(this), $row = $this.parents('tr').first(), id= $row.attr('data-id');

                $.getJSON('/paragraphs/'+id+'/edit', function(response) {

                    $listaParagrafi.hide();
                    $editor.show();
                    $editor.find('.panel-title').text('Modifica Paragrafo "'+response.titolo+'"');
                    $editor.find('input[name=titolo]').val(response.titolo);
                    $editor.find('img').attr('src', 'http://www.halex.it'+response.foto);
                    $editor.find('input[name=foto]').val(response.foto);
                    $editor.find('input[name=id]').val(response.id);
                    $editor.find('textarea:tinymce').tinymce().setContent(response.descrizione);



                });

            })
                .on('click', '.btnMoveUp, .btnMoveDown', function(e) {

                var $this = $(this), $row = $this.parents('tr').first(), id= $row.attr('data-id'), pos = parseInt($row.attr('data-position'));

                if($this.is('.btnMoveUp')) pos--; else pos++;

                $.post('{{ route('paragraphs.move', [null]) }}/'+id, {position: pos}, function() {

                    $row.attr('data-position', pos);
                    if($this.is('.btnMoveUp')) {
                        $row.insertBefore($row.prev());
                    } else {
                        $row.insertAfter($row.next());
                    }

                    $paragrafi.find('tr').each(function(id, li) {
                        $(li).find('button.btnMoveUp').prop('disabled',$(li).is(':first-child'));
                        $(li).find('button.btnMoveDown').prop('disabled',$(li).is(':last-child'));
                    })

                });

            })
                .on('click', '.btnRemove', function(e) {

                    e.preventDefault();

                    var
                        $this = $(this),
                        $row = $this.parents('tr').first(),
                        id = $row.attr('data-id'),
                        $modal = $('div#elimina');

                    $modal.modal();
                    $modal.find('form').attr('action','{{ route('pagesc.destroy',null) }}/'+id);
                    $modal.find('.modal-body #modal-name').text($row.attr('data-name'));
                    $modal.find('.btn-conferma').one('click', function(e) {

                        $modal.modal('hide');

                        $.post('{{ route('paragraphs.destroy', null) }}/'+id, {'_method': 'DELETE'}, function() {
                            $row.remove();
                            $editor.hide();
                            $listaParagrafi.show();

                            $paragrafi.find('tr').each(function(id, li) {
                                $(li).find('button.btnMoveUp').prop('disabled',$(li).is(':first-child'));
                                $(li).find('button.btnMoveDown').prop('disabled',$(li).is(':last-child'));
                            })

                        })
                    });

            });

            $editor
                .on('click','.btnListaParagrafi', function(e) {
                e.preventDefault();

                $editor.hide();
                $listaParagrafi.show();

            })
                .on('click','.btnCambiaImmagine', function(e) {

                    e.preventDefault();
                    uploader.settings.multipart_params['id'] = $editor.find('input[name=id]').val();
                })
                .on('click','.btnSalva', function(e) {

                    e.preventDefault();

                    var $form = $editor.parent(), data = $form.serializeArray();
                    data.push({name: 'descrizione', value: $editor.find('textarea').tinymce().getContent()});

                    $editor.find('.has-error').removeClass('has-error').find('p.help-block').remove();

                    $.post('{{ route('paragraphs.store') }}', data, function(response) {

                        $editor.hide();
                        $listaParagrafi.show();

                        var $row = $paragrafi.find('[data-id='+response.id+']');

                        if(!$row.length) {

                            $row = $('<tr data-id="" data-position="" data-name="">\n    <td class="text-center success" style="width: 24px;">\n        <button href="#" class="btn btn-xs btn-success btnEdit"><i class="fa fa-fw fa-pencil"></i></button>\n    </td>\n    <td class="text-center warning" style="width: 24px;">\n        <button class="btn btn-xs btn-default btnMoveUp"><i class="fa fa-fw fa-chevron-up"></i></button>\n    </td>\n    <td class="text-center warning" style="width: 24px;">\n        <button class="btn btn-xs btn-default btnMoveDown"><i class="fa fa-fw fa-chevron-down"></i></button>\n    </td>\n    <td class="text-center danger" style="width: 24px;">\n        <button href="#" class="btn btn-xs btn-danger btnRemove"><i class="fa fa-fw fa-remove"></i></button>\n    </td>\n    <td></td>\n</tr>');

                            if(!$paragrafi.find('tbody').length) $paragrafi.append('<tbody></tbody>');
                            $paragrafi.find('tbody').append($row);

                        }

                        $row.attr('data-id', response.id);
                        $row.attr('data-name', response.titolo);
                        $row.attr('data-position', response.posizione);
                        $row.find('td:last-child').html(response.titolo);

                        $paragrafi.find('tr').each(function(id, li) {
                            $(li).find('button.btnMoveUp').prop('disabled',$(li).is(':first-child'));
                            $(li).find('button.btnMoveDown').prop('disabled',$(li).is(':last-child'));
                        })

                    }).fail(function(response) {

                        var data = response.responseJSON;

                        if(response.status == 422) {

                            Object.keys(data).forEach(function(field) {

                                var $field = $editor.find('#'+field);
                                $field.parents('.form-group').first().addClass('has-error');
                                $field.after('<p class="help-block">'+data[field]+'</p>');

                            })


                        }


                    });

                });

            $('button.btnNuovoParagrafo').click(function(e) {
                $listaParagrafi.hide();
                $editor.show();
                $editor.find('.panel-title').text('Nuovo Paragrafo');
                $editor.find('input[name=titolo]').val('');
                $editor.find('img').attr('src', '');
                $editor.find('input[name=foto]').val('');
                $editor.find('input[name=id]').val('');
                $editor.find('textarea:tinymce').tinymce().setContent('');
            })

        })

    </script>
@endsection
