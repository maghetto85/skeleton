@extends('layouts.site')
@section('page.title',$page->Titolo)
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

                <div class="@if($page->pictures()->count()) col-lg-8 col-md-8 col-sm-8 @else col-sm-12 @endif">
                    <h2>{{ $page->Titolo }}</h2>

                    <div>{!! $page->Contenuto !!}</div>


                </div>

                @if($page->pictures()->count())
                <div class="col-lg-4 col-md-4 col-sm-4">

                    @foreach($page->pictures as $picture)

                        <h2>
                            <a href="{{ halex_url($picture->Url) }}" class="thumb">
                                <img src="{{ halex_url($picture->Url) }}" alt="">
                            </a>
                        </h2>

                    @endforeach

                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection