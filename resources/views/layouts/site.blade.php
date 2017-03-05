<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('page.title') - Halex Room &amp; Food - Hotel con thermarium a Nettuno</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
    <meta name = "format-detection" content = "telephone=no" />
    <meta name="description" content="Mini Hotel di 6 camere a Nettuno, con area Spa ( Salus Per Aquam), thermarium, nella quale fruire di meravigliosi percorsi relax.">
    <meta name="keywords" content="Hotel, bed and breakfast, Nettuno, Anzio, percorsi benessere, SPA,thermarium, pensione, camere, affitto, turismo, centro benessere">
    <meta name="author" content="VenereSPA Nettuno">
    <meta name="google-site-verification" content="_j97tw5iZXqGk2OTRsvnvv4Zhr5Zz0vxWm0kfhddGU8" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.2.1.js') }}"></script>
    <script src="{{ asset('js/superfish.js') }}"></script>
    <script src="{{ asset('js/jquery.mobilemenu.js') }}"></script>
    <script src="{{ asset('js/jquery.animate-colors-min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.totop.js') }}"></script>
    <script src="{{ asset('js/jquery.touchSwipe.min.js') }}"></script>
    <script src="{{ asset('js/jquery.equalheights.js') }}"></script>
    @yield('page.head')

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.cookiebar.css') }}" />
    <script src="{{ asset('/js/jquery.cookiebar.js') }}"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery.cookieBar({
                message: '{{ __("Questo sito utilizza i cookies per offrirti un'esperienza di navigazione migliore. Usando il nostro servizio accetti l\'impiego di cookie in accordo con la nostra cookie policy.") }}',
                acceptButton: true,
                acceptText: 'OK',
                declineButton: true,
                declineText: 'Rifiuta',
                policyButton: true,
                policyText: 'Informativa Estesa',
                policyURL: '/cookie-policy',
                autoEnable: false,
                acceptOnContinue: false,
                expireDays: 365,
                forceShow: false,
                effect: 'slide',
                element: 'body',
                append: false,
                fixed: true,
                bottom: false,
                zindex: '5222',
                //redirect: '/',
                //domain: 'www.example.com',
                //referrer: 'www.example.com'
            });
        });
    </script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-68918228-1', 'auto');
        ga('send', 'pageview');

    </script>

    <!--[if lt IE 9]>
    <div style='text-align:center'><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="bg2">
<!--==============================header=================================-->
<header id="header" class="bgheader">
    <div class="width_1">
        <h1 class="navbar-brand navbar-brand_"><a href="{{ url('/') }}"><img src="{{ asset('img/logoHalexRoomFoodPagine.png') }}" alt="Halex Room &amp; Food"></a></h1>
        <div class="prenota">
            @foreach(\App\Locale::all() as $locale)
                <a href="{{ url($locale->code) }}"><img src="{{ $locale->flag }}" alt="" title="{{ $locale->name }}"></a>
            @endforeach
        </div>
    </div>


    <div class="menuheader">
        <nav class="navbar navbar-default navbar-static-top tm_navbar" role="navigation">
            <?php loadMenu(); ?>
        </nav>
    </div>

</header>
<!--==============================content=================================-->
<div id="content">
    @yield('content')
</div>

@include('layouts.footer')
</body>
</html>
