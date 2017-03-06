@extends('layouts.site')
@section('page.title',__('Camere'))
@section('content')

    <div class="row_12">
        <div class="container">
            <h2>{{ __("Le nostre camere") }}</h2>
            <p>{{ __("Nate dall'evoluzione del centro estetico, le camere sono arredate con l'attenzione ai colori e all'unicità. Ogni camera ha un suo carattere, un colore dominante che unisce a confort comuni quali Wi-Fi, Tv 40\",Frigo Bar, Cassaforte, aria condizionata, Phon. Le camere Superior oltre al terrazzo privato hanno dettagli per la cosmesi personale, il bollitore per infusi e la biancheria di qualità superiore.") }}</p>

            <div class="row">
                <ul class="list7">

                    @foreach($rooms as $id => $room)

                    <li class="col-lg-4 col-md-4 col-sm-4 roomscol">
                        <figure><a href="{{ route('room',[$room->id, $room->slug]) }}" class="thum2"><img src="{{ halex_url($room->pics()->whereVisibile(1)->inRandomOrder()->first()->miniatura) }}" alt="{{$room->Titolo}} Halex Room &amp; Food"><span></span><strong></strong></a></figure>
                        <div style="margin: 15px 0">
                            <p class="title3 text-center">{{ $room->titolo }} <a href="{{ url('room', [$room->id, $room->slug]) }}" class="btn-link btn-link1 color4"><img src="{{ asset('img/freccia2.png') }}" alt=""></a></p>
                        </div>
                    </li>

                    @if(!(($id+1) % 3))

                </ul>
            </div>
            <div class="row">
                <ul class="list7">
                    @endif

                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection