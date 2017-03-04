@extends('layouts.app')
@section('page.title','Banner in Home')
@section('head')

@endsection
@section('content')
<div class="container">


    <form class="form-inline" style="margin-bottom: 20px;">
        <div class="form-group form-group-sm">

            <select name="lang" id="lang" class="form-control selectpicker" title="Lingua">
                <option value="">Tutte</option>
                @foreach(\App\Locale::orderBy('name')->get() as $locale)
                    <option data-content="<img src=&quot;{{ $locale->flag}}&quot; alt=&quot;&quot; style=&quot;height: 16px; vertical-align: middle;&quot;> {{ $locale->name}}  " value="{{ $locale->code }}"{{ $locale->code == request('lang') ? ' selected' : '' }}>{{ $locale->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group form-group-sm">
            <button class="btn btn-sm btn-default">Cambia Lingua</button>
        </div>
    </form>

    @if(!$homebanner)

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Banner non configurato</h3></div>
            <div class="panel-body">
                <form action="{{route('homebanner.generate', request('lang'))}}" method="post">
                    {{csrf_field()}}
                <h4>Per questa lingua non è stato ancora configurato alcun banner!</h4>
                <button class="btn btn-primary">Crea un banner dalla lingua predefinita</button>
                <a href="{{ url('/') }}" class="btn btn-link">Torna Indietro</a>
                </form>
            </div>
        </div>

    @else

        <div class="panel panel-default">
            <div class="panel-heading">Banner in Home - {{ $homebanner->locale->name }}</div>
            <div class="panel-body">
                <form class="update-form" action="{{ route('homebanner.update', $homebanner->id) }}" method="post">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="id" id="id" value="{{ $homebanner->id }}">
                <div class="row" data-id="{{ $homebanner->id }}">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary cambia-immagine" data-field="foto1">Cambia Immagine</button>
                        </div>
                        <img id="foto1" src="http://www.halex.it{{ $homebanner->foto1 }}" alt="" class="img-thumbnail" style="max-width: 100%; margin-bottom: 20px; max-height: 250px;">
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <button type="button" data-field="foto2" class="btn btn-primary cambia-immagine">Cambia Immagine</button>
                        </div>
                        <img id="foto2" src="http://www.halex.it{{ $homebanner->foto2 }}" alt="" class="img-thumbnail" style="max-width: 100%; margin-bottom: 20px; max-height: 250px;">
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group form-group-sm">
                            <label for="testo" class="control-label">Testo:</label>
                            <input type="text" name="testo" id="testo" class="form-control" value="{{ old('testo', $homebanner->testo) }}">
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="link" class="control-label">Destinazione del Banner:</label>
                            <input type="text" name="link" class="form-control" id="link" value="{{ old('link', $homebanner->link) }}">
                        </div>

                        <div class="form-group form-group-sm">
                            <button class="btn btn-primary btn-save">Salva</button>
                            <a href="{{ url('/') }}" class="btn btn-link">Torna Indietro</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

    @endif


    @foreach([] as $foto)

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@yield('page.title')</h3>
        </div>
        <div class="panel-body" data-foto="{{ $foto->id }}">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-4">
                    <img src="http://www.halex.it{{ $foto->url }}" alt="" class="img-thumbnail center-block" style="margin-bottom: 20px; max-height: 250px;">
                </div>
                <div class="col-sm-8">

                    <div class="form-group form-group-sm">
                        <button class="btn btn-primary cambia-immagine" id="{{ $foto->id }}">Cambia Immagine</button>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group form-group-sm">
                                <label for="" class="control-label">Titolo</label>
                                <input type="text" name="titolo" class="form-control" value="{{ old('titolo', $foto->titolo) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-group-sm">
                                <label for="" class="control-label">Titolo Inglese</label>
                                <input type="text" name="titolo_en" class="form-control" value="{{ old('titolo_en', $foto->titolo_en) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group form-group-sm">
                                <label for="" class="control-label">Url</label>
                                <input type="text" name="link" class="form-control" value="{{ old('link', $foto->link) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-group-sm">
                                <label for="" class="control-label">Url Inglese</label>
                                <input type="text" name="link_en" class="form-control" value="{{ old('link_en', $foto->link_en) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <button class="btn btn-default salva-modifiche">Salva Modifiche</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endforeach

</div>
@endsection

@section('bottom')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/2.2.1/plupload.full.min.js"></script>
    <script>

        $(function() {
            $('button.cambia-immagine').each(function(e) {

                var
                    $pulsante = $(this),
                    $form = $pulsante.parents('form').first(),
                    id = $form.find('input#id').val(),
                    field = $pulsante.attr('data-field'),
                    $image = $form.find('img#'+field);

                var uploader = new plupload.Uploader({
                    browse_button: $pulsante[0],
                    url: '{{ route('homebanner.upload') }}',
                    multipart_params: {
                        id: id,
                        field: field,
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

                    var homebanner = JSON.parse(response.response);

                    $image.attr('src','http://www.halex.it'+homebanner.url);
                    $pulsante.prop('disabled',false).text('Cambia Immagine');
                })

            });

            $('form.update-form').submit(function(e) {
                e.preventDefault();
                var $form = $(this), data = $form.serializeArray();

                $.post($form.attr('action'), data, function(response) {

                    var $message = "<div class=\"alert alert-success alert-dismissable\"><strong>Salvataggio Eseguito!</strong></div>";

                    $form.parents('.panel').before($message);

                }).fail(function() {

                });

            });

            $('forum').on('click',function(e) {
                e.preventDefault();
                var $pulsante = $(this);

                var data = $pulsante.parents('.panel-body').first().find('input[type=text]').map(function(id, input) {

                    return {
                        name: $(input).attr('name'),
                        value: $(input).val()
                    }

                });

                data.push({
                    name: '_token',
                    value: Laravel.csrfToken
                });

                data.push({
                    name: 'id',
                    value: $pulsante.parents('.panel-body').attr('data-id')
                });

                console.log(data);

               // $.post('{{ route('fotohome.save') }}', data);

            })
        })

    </script>

@endsection
