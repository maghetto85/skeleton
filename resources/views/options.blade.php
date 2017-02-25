@extends('layouts.app')
@section('page.title','Opzioni')
@section('head')
    <style>
        .tab-pane {
            padding-top: 15px;
        }
    </style>
@endsection
@section('content')
<div class="container">

    <div class="panel panel-default">
        <div class="panel-body">

            <form action="{{ route('options.save') }}" method="post">

                {{ csrf_field() }}

            <ul class="nav nav-tabs" role="tablist">
                @foreach($groups as $group)
                <li{!! $loop->first ? ' class="active"' : '' !!}><a href="#group{{ $group->id }}" role="tab" data-toggle="tab">{{ $group->name }}</a></li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($groups as $group)
                <div class="tab-pane fade{!! $loop->first ? ' active in' : '' !!}" id="group{{ $group->id }}">

                    @foreach($group->options as $option)

                    <div class="form-group form-group-sm">
                        <input type="hidden" name="{{ $option->slug }}[id]" value="{{ $option->Id }}">
                        <label for="{{ $option->slug }}" class="control-label">{{ utf8_decode($option->name) }}:</label>

                        @if($option->type == OPT_TYPE_TEXT)
                        <input type="text" name="{{ $option->slug }}[value]" id="{{ $option->slug }}" value="{{ $option->value }}" class="form-control">
                        @elseif($option->type == OPT_TYPE_LONG_TEXT)
                        <textarea class="form-control" rows="10" name="{{ $option->slug }}[value]" id="{{ $option->slug }}">{{ $option->value }}</textarea>

                        @elseif($option->type == OPT_TYPE_TOGGLE)

                            <select name="{{ $option->slug }}[value]" id="{{ $option->slug }}" class="form-control">
                                <option value="1"{{ $option->value == 1 ? ' selected' : '' }}>Attivato</option>
                                <option value="0"{{ $option->value == 0 ? ' selected' : '' }}>Disattivato</option>
                            </select>

                        @endif

                    </div>

                    @endforeach

                </div>
                @endforeach
            </div>

            <div class="form-group">

                <button class="btn btn-primary">Salva</button>
                <a href="/" class="btn btn-link">Torna Indietro</a>

            </div>

            </form>

        </div>
    </div>


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
