@extends('layouts.site')
@section('page.title', __('Pagina non trovata'))
@section('content')

    <div class="row_12">
        <div class="container text-center">

            <h1>404</h1>

            <h2>{{ __('La pagina richiesta non è disponibile') }}</h2>

            <h3><a href="{{ url('/') }}">{{ __('Home Page') }}</a></h3>

        </div>
    </div>

@endsection
