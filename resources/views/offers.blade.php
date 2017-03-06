@extends('layouts.site')
@section('page.title', __('Offerte'))
@section('page.head')


@endsection
@section('content')

    <div class="row_12">
        <div class="container">
            <div class="row privacy_page">
                <div class="col-lg-8 col-md-8 col-sm-8" id="listapromo">
                    @if(!count($offers['promozioni']))
                    <p>{{ __("Spiacenti, nessuna Promo!") }}</p>
                    @else

                        @foreach($offers['promozioni'] as $offer)

                    <div data-id="{{ $offer["IdPromozione"] }}" style="overflow: hidden; margin-bottom: 20px; border-bottom: 2px solid #ddd">
                    <img style="float: left; margin: 0 10px 10px 0" src="http://www.venerespa.it{{ $offer["PercorsoMiniatura"] }}">
                    <a href="{{ route('offers', $offer["IdPromozione"]) }}"><h4>{{ $offer["Titolo"] }}</h4></a>
                    <p>{{ __("Valida fino al") }} {{ $offer["DataFV"] }}</p>
                    </div>
                        @endforeach

                @endif
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h2>{{ __("Convenzioni") }}</h2>
                <p>{{ __("Halex  offre ai propri clienti la possibilità di fruire di diverse convenzioni con Ristoranti e gioiellerie di Anzio e Nettuno. Possibilità di convenzioni con società ed Enti.") }}</p>
                <div class="overflow">
                    <p>&nbsp;</p>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection