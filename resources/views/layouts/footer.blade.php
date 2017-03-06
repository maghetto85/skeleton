<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-7 pull-right">
                <div class="line6"></div>
                <ul class="social_icons clearfix">
                    <li style="float: none; width: auto; height: auto; margin-bottom: 10px;">
                        <div id="TA_cdsscrollingravenarrow508" class="TA_cdsscrollingravenarrow">
                            <ul id="tbFe2v" class="TA_links mhh6PBTHKA0G">
                                <li id="kPLSsDQqn" class="ddYMRsCil">
                                    <a target="_blank" href="https://www.tripadvisor.it/">
                                        <img src="https://static.tacdn.com/img2/t4b/Stacked_TA_logo.png" alt="TripAdvisor" class="widEXCIMG" id="CDSWIDEXCLOGO"/></a></li>
                            </ul>
                        </div>
                        <script src="https://www.jscache.com/wejs?wtype=cdsscrollingravenarrow&amp;uniq=508&amp;locationId=8783421&amp;lang={{ $locale }}&amp;border=true&amp;display_version=2"></script>
                    </li>

                    <li><a href="https://plus.google.com/116525972215018648186/about" target="_blank">
                            <img src="{{ asset('img/follow_icon2.png') }}" alt=""></a></li>
                    <li><a href="https://www.facebook.com/pages/HALEX-RoomFood/1630634063842544" target="_blank"><img src="{{ asset('img/follow_icon3.png') }}" alt=""></a></li>
                </ul>
            </div>
            <div class="col-lg-7 col-md-5 col-sm-5 pull-left">
                <p class="footerpriv">Halex Room &amp; Food &copy; 2015/{{ date('Y') }}
                    <img src="{{ asset('img/bulletfooter.jpg') }}" alt="">
                    <a class="privacylink" href="{{ route('page', __("cookie-policy")) }}">{{ __("Cookie - Privacy") }}</a>
                    <a href="{{route('contact')}}"><img src="{{ asset('img/email halex.png') }}"></a><a class="privacylink" href="{{ route('page',__("regolamento")) }}">{{ __("Regolamento") }}</a></p>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/tm-scripts.js') }}"></script>