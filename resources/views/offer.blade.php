@extends('layouts.site')
@section('page.title', ($offer['Titolo'].' - '.__('Offerte')))
@section('page.head')


@endsection
@section('content')

    <div class="row_12">
        <div class="container">
            <div class="row privacy_page">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h2>{{ $offer["Titolo"] }}</h2>
                    <div style="float: right">

                    </div>
                    <div>{!! $offer["Descrizione"] !!}</div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" style="padding-top: 50px; text-align: center">
                    @if($offer['NascondiPW'])
                        @for($i = 0; $i < strlen($offer['Prezzo']); $i++)
                        <img alt="" style="display: inline; vertical-align: middle" src="http://www.venerespa.it/images/numeri/{{ (int)$offer['Prezzo'][$i] }}.png" />
                        @endfor
                        <img alt="" style="display: inline; vertical-align: middle" src="http://www.venerespa.it/images/numeri/cent.png" />
                        <img alt="" style="display: inline; vertical-align: middle" src="http://www.venerespa.it/images/numeri/euro.png" />

                    @else

                        {{ __("A partire da") }}<br>

                        @for($i = 0; $i < strlen($offer['PrezzoWeb']); $i++)
                            <img alt="" style="display: inline; vertical-align: middle" src="http://www.venerespa.it/images/numeri/{{ (int)$offer['PrezzoWeb'][$i] }}.png" />
                        @endfor
                        <img alt="" style="display: inline; vertical-align: middle" src="http://www.venerespa.it/images/numeri/cent.png" />
                        <img alt="" style="display: inline; vertical-align: middle" src="http://www.venerespa.it/images/numeri/euro.png" />


                    @endif

                    <div style="margin-top: 20px; padding: 20px; text-align: center">
                        <a href="http://www.venerespa.it/promo.asp?idpromo={{ $offer["IdPromozione"] }}" onclick="window.open(this.href); return false;">
                        <img alt="" src="{{ asset("/img/acquista_online.jpg") }}" onmouseout="$(this).attr('src','{{ asset("/img/acquista_online.jpg") }}')" onmouseover="$(this).attr('src','{{ asset("/img/acquista_online2.jpg") }}')" style="margin: 5px;"></a>
                        <br><strong>{{ __("ACQUISTA ONLINE DA VENERESPA.IT") }}</strong>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <h2><img src="http://www.venerespa.it{{ $offer["PercorsoFoto"]}}"></h2>

                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>

            </div>
    </div>
    </div>

@endsection