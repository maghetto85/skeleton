<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halex Room &amp; Food - Hotel con thermarium a Nettuno</title>
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
    <link rel="stylesheet" href="{{ asset('css/touchTouch.css') }}">

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/touchTouch.jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.2.1.js') }}"></script>
    <script src="{{ asset('js/superfish.js') }}"></script>
    <script src="{{ asset('js/jquery.mobilemenu.js') }}"></script>
    <script src="{{ asset('js/jquery.animate-colors-min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.totop.js') }}"></script>
    <script src="{{ asset('js/jquery.touchSwipe.min.js') }}"></script>
    <script src="{{ asset('js/jquery.equalheights.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.cookiebar.css') }}" />
    <script src="{{ asset('/js/jquery.cookiebar.js') }}"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery.cookieBar({
                message: '{{ __("Questo sito utilizza i cookies per offrirti un'esperienza di navigazione migliore. Usando il nostro servizio accetti l\'impiego di cookie in accordo con la nostra cookie policy.") }}',
                acceptButton: true,
                acceptText: 'OK',
                declineButton: true,
                declineText: '{{ __("Rifiuta") }}',
                policyButton: true,
                policyText: '{{ __("Informativa Estesa") }}',
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
        $(window).load(function() {

            // Initialize the gallery
            $('.thumb').touchTouch();

            //btn-link hover
            $('.color1').hover(function(){
                $(this).parent().parent().parent().find('figure span').stop().animate({ 'top': "100%"}, 450, "easeOutExpo")
                $(this).stop().animate({ 'color': "#f26522"}, 150, "easeOutExpo")
            }, function(){
                $(this).parent().parent().parent().find('figure span').stop().animate({ 'top': "0"}, 450, "easeOutExpo")
                $(this).stop().animate({ 'color': "#FFFFFF"}, 350, "easeOutExpo")
            })
            $('.color2').hover(function(){
                $(this).parent().parent().parent().find('figure span').stop().animate({ 'top': "100%"}, 450, "easeOutExpo")
                $(this).stop().animate({ 'color': "#f222b2"}, 150, "easeOutExpo")
            }, function(){
                $(this).parent().parent().parent().find('figure span').stop().animate({ 'top': "0"}, 450, "easeOutExpo")
                $(this).stop().animate({ 'color': "#FFFFFF"}, 350, "easeOutExpo")
            })
            $('.color3').hover(function(){
                $(this).parent().parent().parent().find('figure span').stop().animate({ 'top': "100%"}, 450, "easeOutExpo")
                $(this).stop().animate({ 'color': "#f2b422"}, 150, "easeOutExpo")
            }, function(){
                $(this).parent().parent().parent().find('figure span').stop().animate({ 'top': "0"}, 450, "easeOutExpo")
                $(this).stop().animate({ 'color': "#FFFFFF"}, 350, "easeOutExpo")
            })
            $('.color4').hover(function(){
                $(this).parent().parent().parent().find('figure span').stop().animate({ 'top': "100%"}, 450, "easeOutExpo")
                $(this).stop().animate({ 'color': "#5e22f2"}, 150, "easeOutExpo")
            }, function(){
                $(this).parent().parent().parent().find('figure span').stop().animate({ 'top': "0"}, 450, "easeOutExpo")
                $(this).stop().animate({ 'color': "#FFFFFF"}, 350, "easeOutExpo")
            })

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
<body class="bg1">
<!--==============================header=================================-->
<header id="header">
    <div class="width_1">
        <div class="navbar-brand navbar-brand_"><img src="{{ asset('img/logoHalexRoomFood.png') }}" alt="Halex Room &amp; Food">
            <div class="prenota">
                <a class="prenota-link" href="{{ route('prenotations') }}" style="color: #fff;">{{ __("PRENOTA CAMERA") }}</a>
                @foreach(\App\Locale::all() as $locale)
                    <a href="{{ url($locale->code) }}"><img src="{{ $locale->flag }}" alt="" title="{{ $locale->name }}"></a>
                @endforeach
            </div>
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
    <!--==============================row_1=================================--><!--==============================row_2=================================-->
    <div class="row_2">
        <div class="container">
            <div class="row">
                <ul class="list2">
                    @foreach($homefoto as $id => $hfoto)
                        <li class="col-lg-3 col-md-3 col-sm-3 collist2">
                            <a href="{{ $hfoto->link }}">
                                <figure style="border-radius: {{ get_option('fotohome.radius') }}px">
                                    <img src="{{ $hfoto->url }}" data-src="{{ $hfoto->url }}" class="img-responsive" alt="{{ $hfoto->titolo }}"></figure></a>
                            <div class="infotext{{ $id+1 }} maxheight">
                                <a href="{{ $hfoto->link }}" class="btn-link btn-link1 color4"><h4>{{ $hfoto->titolo }}</h4></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!--==============================row_3=================================-->
    <div class="row_3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 row3col">
                    <h4 class="useful_info">{{ __("Info utili") }}</h4>
                    <ul class="list3">
                        @foreach($menuv as $menuitem)
                            <li>
                                <a href="{{ $menuitem->url }}">{{ $menuitem->titolo }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-5 row3col1">
                    <div class="box1 clearfix">
                        <figure><a href="{{ $homebanner->link }}"><img src="{{ $homebanner->foto1 }}" alt=""></a></figure>
                        <div class="infotext2">
                            <p>{{ $homebanner->testo }}</p>
                            <p><a href="{{ $homebanner->link }}" class="btn-link btn-link2">{{ __('scopri di più') }} <span>&bull;</span></a></p>
                            <h2><img src="{{ $homebanner->foto2 }}" alt=""></h2>

                        </div>
                    </div>
                </div>
                <div class="col-lg-offset-1 col-lg-4 col-md-4 col-sm-4 row3col2">
                    <ul class="list-info">
                        @foreach($rooms as $room)
                            <li>
                                <div class="badge_ badgecolor1 badge"><p><img src="{{ halex_url($room->pics()->first()->miniatura) }}"></p>
                                </div>
                                <div class="overflow">
                                    <p class="color5">{{ $room->titolo }}</p>
                                    <p>{!! str_limit($room->descrizionelocale,150) !!}</p>
                                    <a href="{{ route('room',[$room->id, $room->slug]) }}" class="btn-link btn-link4">{{ __('scopri di più') }}... <span>&bull;</span></a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{route('rooms')}}" class="btn-link btn-link3 badges">{{ __("tutte le camere") }} <span>&bull;</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
</body>
</html>