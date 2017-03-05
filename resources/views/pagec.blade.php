@extends('layouts.site')
@section('page.title',$page->titolo)
@section('page.head')
    <link rel="stylesheet" href="{{ asset('css/touchTouch.css') }}">
    <script src="{{ asset('js/touchTouch.jquery.js') }}"></script>

    <script>
        $(window).load(function() {
            $('.thumb').touchTouch();
        });
    </script>

@endsection
@section('content')

    <div class="row_12">
        <div class="container">

            <div class="row">

                @foreach($page->paragraphs()->limit(3)->get() as $paragraph)

                <div class="col-lg-4 col-md-4 col-sm-4 about_us">

                    <h2>{{ $paragraph->titolo  }}</h2>
                    @if($paragraph->foto)

                        <figure><img src="{{halex_url($paragraph->foto)}}" alt=""></figure>

                    @endif

                    <div class="page_content text-left">
                        {!! $paragraph->descrizione !!}
                    </div>

                </div>

                @endforeach

            </div>
            <div class="row">

                @foreach($page->paragraphs()->skip(3)->limit(4)->get() as $paragraph)

                <div class="col-lg-3 col-md-3 col-sm-3 about_us">

                    <h2>{{ $paragraph->titolo  }}</h2>
                    @if($paragraph->foto)

                        <figure><img src="{{halex_url($paragraph->foto)}}" alt=""></figure>

                    @endif

                    <div class="page_content text-left">
                        {!! $paragraph->descrizione !!}
                    </div>

                </div>

                @endforeach

            </div>
        </div>
    </div>

@endsection