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
                <h4>Per questa lingua non è stato ancora configurato alcun banner!</h4>
                <a href="#" class="btn btn-primary">Crea un banner dalla lingua predefinita</a>
                <a href="{{ url('/') }}" class="btn btn-link">Torna Indietro</a>
            </div>
        </div>

    @else

        <div class="panel panel-default">
            <div class="panel-heading">Banner in Home - {{ $homebanner->locale->name }}</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <button class="btn btn-primary">Cambia Immagine</button>
                        </div>
                        <img src="http://www.halex.it{{ $homebanner->foto1 }}" alt="" class="img-thumbnail" style="max-width: 100%; margin-bottom: 20px; max-height: 250px;">
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <button class="btn btn-primary">Cambia Immagine</button>
                        </div>
                        <img src="http://www.halex.it{{ $homebanner->foto2 }}" alt="" class="img-thumbnail" style="max-width: 100%; margin-bottom: 20px; max-height: 250px;">
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
                            <button class="btn btn-primary">Salva</button>
                            <a href="{{ url('/') }}" class="btn btn-link">Torna Indietro</a>
                        </div>
                    </div>
                </div>

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
            $('button.cambia-immagine').each(function() {

                var $pulsante = $(this);


                var uploader = new plupload.Uploader({
                    browse_button: $pulsante.attr('id'),
                    url: '{{ route('fotohome.upload') }}',
                    multipart_params: {
                        id: $pulsante.attr('id'),
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

                    var homefoto = JSON.parse(response.response);

                    var $box = $('.panel-body[data-foto='+homefoto.id+']');
                    $box.find('img').attr('src','http://www.halex.it'+homefoto.url);

                    $pulsante.prop('disabled',false).text('Cambia Immagine');
                })


            });
            $('button.salva-modifiche').on('click',function(e) {
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
                    value: $pulsante.parents('.panel-body').attr('data-foto')
                });

                $.post('{{ route('fotohome.save') }}', data);

            })
        })

    </script>

@endsection
