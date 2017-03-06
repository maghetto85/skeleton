@extends('layouts.site')
@section('page.title',__('Contattaci'))
@section('page.head')<script src="{{ asset('js/TMForm.js') }}"></script>
@endsection
@section('content')

    <div class="row_12">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 address">
                    <h2>Halex Room&amp;Food</h2>
                    <address>
                        <div class="info">
                            <p>Via FRIULI 7<br>00048 Nettuno –Roma<br>Reception dal martedi al sabato in orario continuato
                                dalle ore 9,00 alle ore 19,30 ai numeri:<br>069805019- 3351806070-0698831360<br>
                                Negli orari o giorni diversi contattare:<br>
                                3398885506  Gregorio<br>
                                3459914300 Alessandro                        	</p>
                            <p><img src="{{ asset('img/email halex.png') }}"></p>
                        </div>
                    </address>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h2>{{ __("Compila il modulo per contattarci") }}</h2>
                    <form id="contact-form" class="contact-form">
                        <div class="success-message" style="font-size: 20px;font-weight: bold;background-color: red;color: white;">
                            <div>{{ __("Modulo inviato correttamente!") }}</div>
                        </div>
                        <div class="coll-1">
                            <label class="name">
                                <input type="text" placeholder="Name:" data-constraints="@Required @JustLetters" />
                                <span class="empty-message">{{ __("Campo obbligatorio.") }}</span>
                                <span class="error-message">{{ __("Inserito un nome non valido.") }}</span>
                            </label>
                        </div>
                        <div class="coll-2">
                            <label class="email">
                                <input type="text" placeholder="Email:" data-constraints="@Required @Email" />
                                <span class="empty-message">{{ __("Campo obbligatorio.") }}</span>
                                <span class="error-message">{{ __("Email inserita non valida.") }}</span>
                            </label>
                        </div>
                        <div class="coll-3">
                            <label class="phone">
                                <input type="text" placeholder="Telefono:" data-constraints="@JustNumbers"/>
                                <span class="empty-message">{{ __("Campo obbligatorio.") }}</span>
                                <span class="error-message">{{ __("Numero di telefono non valido.") }}</span>
                            </label>
                        </div>
                        <label class="message">
                            <textarea placeholder="Message:" data-constraints='@Required @Length(min=5,max=999999)'></textarea>
                            <span class="empty-message">{{ __("Campo obbligatorio.") }}</span>
                            <span class="error-message">{{ __("Messaggio troppo corto.") }}</span>
                        </label>
                        <div class="buttons_wrapper">
                            <a href="#" data-type="submit" class="btn-link btn-link3">Invia messaggio <span>&bull;</span></a>
                            <p>{{ __("Campi obbligatori.") }}</p>
                        </div>
                    </form>
                </div>
            </div>
           <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2990.0762744380836!2d12.656671315428005!3d41.45926097925766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1325a37cff97b6df%3A0x4af33f00b7de91cc!2sHalex+Room+%26+Food!5e0!3m2!1sit!2sit!4v1443731607203" height="500" frameborder="0" style="border:0; width: 100%" allowfullscreen=""></iframe>
                <div class="col-lg-12 col-md-12 col-sm-12 gmap">
                    <div class="map"></div>
                </div>
           </div>

        </div>
    </div>

@endsection