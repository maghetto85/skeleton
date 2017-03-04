@extends('layouts.app')
@section('page.title',$room->exists ? $room->titolo : 'Nuova Camera')
@section('page.navbar')
    <li><a href="{{ route('rooms.index') }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Camere</a></li>
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

    <form method="post" action="{{ $room->exists ? route('rooms.update', $room->id) : route('rooms.store') }}">
        {{ csrf_field() }}
        @if($room->exists)
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
                <h3 class="panel-title">@if($room->exists) Modifica Camera @else Nuova Camera @endif</h3>
            </div>
            <div class="panel-body">

                <div class="form-group form-group-sm{{ $errors->has('titolo') ? ' has-error' : '' }}">
                    <label for="titolo" class="control-label">Titolo:</label>
                    <input type="text" id="titolo" name="titolo" value="{{ old('titolo', $room->titolo) }}" class="form-control">
                    @if($errors->has('titolo'))
                        <p class="help-block">
                            {{ $errors->first('titolo') }}
                        </p>
                    @endif
                </div>

                <div class="form-group form-group-sm{{ $errors->has('descrizione') ? ' has-error' : '' }}">
                    <label for="descrizione" class="control-label">Descrizione:</label>
                    <textarea id="descrizione" name="descrizione" class="form-control">{{ old('descrizione', $room->descrizione) }}</textarea>
                    @if($errors->has('descrizione'))
                        <p class="help-block">
                            {{ $errors->first('descrizione') }}
                        </p>
                    @endif
                </div>

                <div class="form-group form-group-sm{{ $errors->has('descrizione_en') ? ' has-error' : '' }}">
                    <label for="descrizione_en" class="control-label">Descrizione (Inglese):</label>
                    <textarea id="descrizione_en" name="descrizione_en" class="form-control">{{ old('descrizione_en', $room->descrizione_en) }}</textarea>
                    @if($errors->has('descrizione_en'))
                        <p class="help-block">
                            {{ $errors->first('descrizione_en') }}
                        </p>
                    @endif
                </div>

                <ul class="nav nav-tabs">
                @foreach($locales = \App\Locale::orderBy('name')->get() as $locale)
                    <li class="{{ $loop->first ? 'active': ''  }}">
                        <a href="#{{ $locale->code }}" data-toggle="tab">
                            <img src="{{ $locale->flag}}" alt="" style="height: 16px; vertical-align: middle;">
                            {{ $locale->name }}
                        </a>
                    </li>
                @endforeach
                </ul>

                <div class="tab-content">
                    @foreach($locales as $locale)
                    <div class="tab-pane fade{{ $loop->first ? ' active in' : '' }}" id="{{ $locale->code }}">
                        <div class="panel-body">

                            <div class="form-group form-group-sm{{ $errors->has("{$locale->code}.descrizione") ? ' has-error' : '' }}">
                                <label for="descrizione" class="control-label">Descrizione:</label>
                                <textarea id="{{ $locale->code }}[descrizione]" name="{{ $locale->code }}[descrizione]" class="form-control">{{ old("{$locale->code}.descrizione", ($lc = $room->locales()->find($locale->id)) ? $lc->pivot->description : '') }}</textarea>
                                @if($errors->has("{$locale->code}.descrizione"))
                                    <p class="help-block">
                                        {{ $errors->first("{$locale->code}.descrizione") }}
                                    </p>
                                @endif
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>



                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('rooms') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>

    </form>

        @if($room->exists)

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Gestione Foto Camera</h3>
            </div>
            <div class="panel-body" id="images-box">

                <ul id="images">
                    @foreach($room->pics as $pic)
                    <li class="col-xs-6 col-sm-3 col-md-2" style="padding-bottom: 10px; height: 110px; text-align: center">
                        <div class="well" style="padding: 2px;">
                            <img src="http://www.halex.it{{ $pic->miniatura }}" alt="" class="img-rounded center-block" style="max-width: 100px; max-height: 100px;">
                            <div class="btn-group btn-group-xs">
                                <button class="btn btn-default"><i class="fa fa-chevron-left"></i></button>
                                <button class="btn btn-default"><i class="fa fa-eye-slash"></i></button>
                                <button class="btn btn-default"><i class="fa fa-remove"></i></button>
                                <button class="btn btn-default"><i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <button class="btn btn-default btn-aggiungi-pic">Aggiungi Immagine</button>
                <a href="{{ url('rooms') }}" class="btn btn-link">Torna Indietro</a>

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
            url : "{{ route('rooms.upload') }}",

            multipart_params: {
                id: {{ $room->id }},
                _token: Laravel.csrfToken
            },

            // Maximum file size
            max_file_size : '2mb',

            chunk_size: '1mb',

            // Specify what files to browse for
            filters : [
                {title : "Image files", extensions : "jpg,gif,png"}
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
            })
        })

    </script>

@endsection
