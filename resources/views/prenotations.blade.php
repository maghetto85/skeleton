@extends('layouts.site')
@section('page.title',__('Prenota'))
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
                                dalle ore 9,00 alle ore 19,30 ai numeri:<br>
                                <strong>069805019- 3351806070-0698831360</strong><br>
                                Negli orari o giorni diversi contattare:<br>
                                <strong>3398885506</strong> Gregorio<br>
                                <strong>3459914300</strong> Alessandro </p>
                            <p><img src="img/email halex.png"></p>
                        </div>
                    </address>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h2>Prenota Online</h2>
                    <form id="contact-form" class="contact-form prenotazioni">
                        <div class="success-message" style="font-size: 20px;font-weight: bold;background-color: red;color: white;">
                            <div>Modulo inviato correttamente!</div></div>
                        <div class="coll-1">
                            <label class="nome">
                                <input type="text" placeholder="Nome*:" data-constraints="@Required @JustLetters" />
                                <span class="empty-message">*Campo obbligatorio.</span>
                                <span class="error-message">*Inserito un nome non valido.</span>
                            </label>
                        </div>
                        <div class="coll-2">
                            <label class="email">
                                <input type="text" placeholder="Email*:" data-constraints="@Required @Email" />
                                <span class="empty-message">*Campo obbligatorio.</span>
                                <span class="error-message">*Email inserita non valida.</span>
                            </label>
                        </div>
                        <div class="coll-3">
                            <label class="nradulti">
                                <input type="text" placeholder="Numero Adulti:" data-constraints="@Required @JustNumbers"/>
                                <span class="empty-message">*Campo obbligatorio.</span>
                                <span class="error-message">*Numero non valido.</span>
                            </label>
                        </div>
                        <div class="coll-1">
                            <label class="dataarrivo">
                                <input type="date" data-placeholder="Arrivo (dd/mm/yyyy) *" data-constraints="@Required @JustDate" />
                                <span class="empty-message">*Campo obbligatorio.</span>
                                <span class="error-message">*Data di arrivo non valida.</span>
                            </label>
                        </div>
                        <div class="coll-2">
                            <label class="datapartenza">
                                <input type="date" data-placeholder="Partenza (dd/mm/yyyy) *" data-constraints="@Required @JustDate" />
                                <span class="empty-message">*Campo obbligatorio.</span>
                                <span class="error-message">*Data di Partenza non valida.</span>
                            </label>
                        </div>
                        <div class="coll-3">
                            <label class="nrbambini">
                                <input type="text" placeholder="Numero Bambini:" data-constraints="@JustNumbers"/>
                                <span class="empty-message">*Campo obbligatorio.</span>
                                <span class="error-message">*Numero non valido.</span>
                            </label>
                        </div>
                        <div class="coll-1">
                            <label class="camera">
                                <select data-constraints="@Required @JustNumbers">
                                    <option>Seleziona la Camera</option>
                                    <% Set RS = DB.Query("SELECT * FROM camere Order by Titolo")
                                    Do While Not RS.Eof %>
                                    <option value="<% =RS("id") %>"<% If IdRoom = RS("id") Then Response.Write " selected"%>><% =RS("titolo") %></option>
                                    <% RS.MoveNext
                                    Loop
                                    RS.Close : Set RS = Nothing %>

                                </select>
                                <span class="empty-message">*Campo obbligatorio.</span>
                                <span class="error-message">*Numero non valido.</span>
                            </label>
                        </div>
                        <label class="message">
                            <textarea style="height: auto" rows="4" placeholder="Note:" data-constraints='@Length(min=5,max=999999)'></textarea>
                            <span class="empty-message">*Campo obbligatorio.</span>
                            <span class="error-message">*Messaggio troppo corto.</span>
                        </label>
                        <div class="buttons_wrapper">
                            <a href="#" data-type="submit" class="btn-link btn-link3">Richiedi Prenotazione <span>&bull;</span></a>
                            <p>*Campi obbligatori</p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection