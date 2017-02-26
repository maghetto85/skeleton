@extends('layouts.app')
@section('page.title', ( ($page->exists ? $page->Titolo : 'Nuova Pagina') .' - Pagine') )
@section('page.navbar')
    <li><a href="{{ route('pages.index') }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Pagine</a></li>
@endsection
@section('head')

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

    </style>
@endsection
@section('content')
<div class="container">

    <form method="post" action="{{ $page->exists ? route('pages.update', $page->id) : route('pages.store') }}">
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

                <div class="form-group form-group-sm{{ $errors->has('lang') ? ' has-error' : '' }}">
                    <label for="lang" class="control-label">Lingua:</label>
                    <select name="lang" id="lang" class="form-control">
                    @foreach(\App\Locale::orderBy('name')->get() as $locale)
                        <option value="{{ $locale->code }}"{{ $locale->code == old('lang',$page->lang) ? ' selected' : '' }}>{{ $locale->name }}</option>
                    @endforeach
                    </select>
                    @if($errors->has('Lang'))
                        <p class="help-block">
                            {{ $errors->first('lang') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group form-group-sm{{ $errors->has('Titolo') ? ' has-error' : '' }}">
                    <label for="Titolo" class="control-label">Titolo:</label>
                    <input type="text" id="Titolo" name="Titolo" value="{{ old('Titolo', $page->Titolo) }}" class="form-control">
                    @if($errors->has('Titolo'))
                        <p class="help-block">
                            {{ $errors->first('Titolo') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group form-group-sm{{ $errors->has('Slug') ? ' has-error' : '' }}">
                    <label for="Slug" class="control-label">Slug:</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">
                            http://www.halex.it/
                        </span>
                        <input type="text" id="Slug" name="Slug" value="{{ old('Slug', $page->Slug) }}" class="form-control">
                    </div>

                    @if($errors->has('Slug'))
                        <p class="help-block">
                            {{ $errors->first('Slug') }}
                        </p>
                    @endif
                </div>

                <div class="form-group form-group-sm{{ $errors->has('Contenuto') ? ' has-error' : '' }}">
                    <label for="Contenuto" class="control-label">Contenuto:</label>
                    <textarea id="Contenuto" name="Contenuto" class="form-control">{{ old('Contenuto', $page->Contenuto) }}</textarea>
                    @if($errors->has('Contenuto'))
                        <p class="help-block">
                            {{ $errors->first('Contenuto') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('pages') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>

    </form>

    @if($page->exists)

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Gestione Foto Pagina</h3>
            </div>
            <div class="panel-body" id="images-box">

                <ul id="images">
                    @foreach($page->pictures()->orderBy('Posizione')->get() as $pic)
                        <li class="col-xs-6 col-sm-3 col-md-2" style="padding-bottom: 10px; height: 110px; text-align: center" data-image="{{ $pic->IdFoto }}" data-position="{{ $pic->Posizione }}">
                            <div class="well" style="padding: 2px;">
                                <img src="http://www.halex.it{{ $pic->Miniatura }}" alt="" class="img-rounded center-block" style="max-width: 100px; max-height: 100px;">
                                <div class="btn-group btn-group-xs">
                                    <button class="btn btn-default btnMoveLeft"{{ $loop->first ? ' disabled' : '' }}><i class="fa fa-chevron-left"></i></button>
                                    <button class="btn btn-default btnRemove"><i class="fa fa-remove"></i></button>
                                    <button class="btn btn-default btnMoveRight"{{ $loop->last ? ' disabled' : '' }}><i class="fa fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <button class="btn btn-default btn-aggiungi-pic">Aggiungi Immagine</button>
                <a href="{{ route('pages.index') }}" class="btn btn-link">Torna Indietro</a>

            </div>
            <div class="panel-body" id="uploader" style="display: none">

            </div>
        </div>

    @endif

</div>
@endsection

@section('bottom')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/jquery.tinymce.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/2.2.1/plupload.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/2.2.1/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/2.2.1/i18n/it.js"></script>

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

        $("#uploader").pluploadQueue({
            // General settings
            runtimes : 'html5,flash,silverlight,html4',
            url : "{{ route('pages.upload') }}",

            multipart_params: {
                id: {{ $page->Id }},
                _token: Laravel.csrfToken
            },

            // Maximum file size
            max_file_size : '2mb',

            chunk_size: '1mb',

            // Specify what files to browse for
            filters : [
                {title : "Image files", extensions : "jpg,gif,png,jpeg"}
            ],

            // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
            dragdrop: true,

            // Views to activate
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },

            // Flash settings
            flash_swf_url : '/admin/js/plupload/Moxie.swf',

            // Silverlight settings
            silverlight_xap_url : '/admin/js/plupload/Moxie.xap',

            init: {

                fileUploaded: function (uploader, file, response) {

                },

                uploadComplete: function(uploader, files) {

                    location.reload();

                }
            }



        });

        $(function() {

            $('button.btn-aggiungi-pic').click(function(e) {
                e.preventDefault();
                $('#uploader').show();
                $('#images-box').hide();
            });

            $('#images-box').on('click','button.btnMoveLeft, button.btnMoveRight', function(e) {

                var $this = $(this), $li = $this.parents('li').first(), id = $li.attr('data-image'), pos = parseInt($li.attr('data-position'));

                if($this.is('.btnMoveLeft')) pos--; else pos++;

                $.post('{{ route('pages.images.move', [$page->Id, null]) }}/'+id, {position: pos}, function() {

                    $li.attr('data-position', pos);
                    if($this.is('.btnMoveLeft')) {
                        $li.insertBefore($li.prev());
                    } else {
                        $li.insertAfter($li.next());
                    }
                    $('div#images-box li').each(function(id, li) {

                        $(li).find('button.btnMoveLeft').prop('disabled',$(li).is(':first-child'));
                        $(li).find('button.btnMoveRight').prop('disabled',$(li).is(':last-child'));

                    })
                });



            }).on('click','button.btnRemove', function(e) {

                var $this = $(this), $li = $this.parents('li').first(), id = $li.attr('data-image');

                $.post('{{ route('pages.images.remove', [$page->Id, null]) }}/'+id, function() {
                    $li.remove();
                    $('div#images-box li').each(function(id, li) {

                        $(li).find('button.btnMoveLeft').prop('disabled',$(li).is(':first-child'));
                        $(li).find('button.btnMoveRight').prop('disabled',$(li).is(':last-child'));

                    })
                });

            })


        })

    </script>

@endsection
