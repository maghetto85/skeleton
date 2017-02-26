@extends('layouts.app')
@section('page.title', ( ($page->exists ? $page->titolo : 'Nuova Pagina') .' - Pagine') )
@section('page.navbar')
    <li><a href="{{ route('pagesc.index') }}"><i class="fa fa-chevron-left fa-fw"></i> Lista Pagine</a></li>
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
                
                <div class="form-group form-group-sm{{ $errors->has('titolo') ? ' has-error' : '' }}">
                    <label for="titolo" class="control-label">Titolo:</label>
                    <input type="text" id="titolo" name="titolo" value="{{ old('titolo', $page->titolo) }}" class="form-control">
                    @if($errors->has('titolo'))
                        <p class="help-block">
                            {{ $errors->first('titolo') }}
                        </p>
                    @endif
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

                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Paragrafi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($page->paragraphs()->orderBy('posizione')->get() as $paragraph)
                    <tr>
                        <td>{{$paragraph->titolo }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <ul class="list-group">
                    @foreach($page->paragraphs()->orderBy('posizione')->get() as $paragraph)
                    <li class="list-group-item">{{$paragraph->titolo }}</li>
                    @endforeach
                </ul>


                <div class="form-group">
                    <button class="btn btn-primary">Salva</button>
                    <a href="{{ url('pages') }}" class="btn btn-link">Torna Indietro</a>
                </div>
            </div>
        </div>

    </form>


</div>
@endsection

@section('bottom')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/jquery.tinymce.min.js"></script>
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

    </script>
@endsection
