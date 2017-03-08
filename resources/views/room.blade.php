@extends('layouts.site')
@section('page.title', $room->titolo)
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
            <h2><a href="{{ route('rooms') }}">{{ __("Le nostre camere") }}</a> <img src="{{ asset('/img/freccia2.png') }}" alt=""> {{$room->titolo}}</h2>
            <div>
                {!! $room->descrizionelocale !!}
            </div>
            
            <h5><a href="{{route('prenotations',['room' => $room->id])}}">{{ __('PRENOTA ORA QUESTA CAMERA') }}</a></h5>

            <div class="row" style="padding-top: 15px; padding-bottom: 15px;">
                <ul class="list7">

                    @foreach($room->pics()->whereVisibile(1)->orderBy('posizione')->get() as $id => $picture)

                    <li class="col-lg-4 col-md-4 col-sm-4 roomscol">
                        <figure><a href="{{ halex_url($picture->url) }}" class="thumb"><img src="{{ halex_url($picture->url) }}" alt="{{$room->Titolo}} Halex Room &amp; Food"><span></span><strong></strong></a></figure>
                    </li>

                    @if(!(($id+1) % 3))

                </ul>
            </div>
            <div class="row" style="padding-top: 15px; padding-bottom: 15px;">
                <ul class="list7">
                    @endif

                    @endforeach
                </ul>
            </div>

            <br>
            <p>{{ __("Il prezzo della camera comprende uno sconto del 20% sui qualsiasi trattamento estetico da consultare su") }} <a href="http://www.venerespa.it" target="_blank">www.venerespa.it</a></p>

        </div>
    </div>

@endsection