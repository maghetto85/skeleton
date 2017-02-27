<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fattura</title>
    <style>

        @page { margin: 10mm; font-family: 'Arial', sans-serif; font-size: 12px ; }

    </style>

</head>


<table style="width: 100%;">
    <tr>
        <td style="width: 25%;">
            <img src="http://halex.it/img/logoHalexRoomFood.png" style="width: 100px; height: 132.828px;">
        </td>
        <td style="width: 25%;">
            <h3>Venerespa S.r.l.</h3>
            Via vittorio veneto, 24<br>
            00048 NETTUNO – RM <br>
            P.IVA e C.F. 13479541008<br>
            cap. sociale 10.000€<br>
            06/9805019 – 335/1806070<br>
            Info@venerespa.it
        </td>
        <td style="width: 50%; border: 1px solid #ddd; padding: 5px; vertical-align: top">
            <h4>{{ $invoice->Nome }}</h4>
            {{ $invoice->Indirizzo }}<br>
            {{$invoice->Cap}} {{$invoice->Citta }} ({{ $invoice->Provincia }})

        </td>
    </tr>
</table>

<p>&nbsp;</p>

<table style="width: 100%" cellspacing="0" cellpadding="4">
    <tr>
        <td style="width: 50%">
            <table style="width: 100%; border: 1px solid #ddd;" cellspacing="0" cellpadding="4">
                <tr>
                    <th style="border-bottom: 1px solid #ddd; width: 50%; border-right: 1px solid #ddd; padding: 4px">Tipo Documento:</th>
                    <td style="border-bottom: 1px solid #ddd; width: 50%; padding: 4px;">Fattura</td>
                </tr>
                <tr>
                    <th style="border-bottom: 1px solid #ddd; width: 50%; border-right: 1px solid #ddd; padding: 4px">Data Documento:</th>
                    <td style="border-bottom: 1px solid #ddd; width: 50%; padding: 4px;">{{$invoice->data->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th style="width: 50%; border-right: 1px solid #ddd; padding: 4px">Numero Documento:</th>
                    <td style="width: 50%; padding: 4px;">{{ $invoice->numero }} / {{ $invoice->data->format('Y')}} </td>
                </tr>
            </table>
        </td>
        <td style="vertical-align:top; width: 50%">
            <table style="width: 100%; border: 1px solid #ddd;" cellspacing="0" cellpadding="4">
                <tr>
                    <th style="border-bottom: 1px solid #ddd; width: 50%; border-right: 1px solid #ddd; padding: 4px">Codice Fiscale:</th>
                    <td style="border-bottom: 1px solid #ddd; width: 50%; padding: 4px;">{{ $invoice->CodiceFiscale }}</td>
                </tr>
                <tr>
                    <th style="border-bottom: 1px solid #ddd; width: 50%; border-right: 1px solid #ddd; padding: 4px">Partita Iva:</th>
                    <td style="border-bottom: 1px solid #ddd; width: 50%; padding: 4px;">{{ $invoice->PartitaIva }}</td>
                </tr>
                <tr>
                    <th style="width: 50%; border-right: 1px solid #ddd; padding: 4px">Indirizzo E-Mail:</th>
                    <td style="width: 50%; padding: 4px;">{{ $invoice->customer->email or '' }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br><br>

<table style="width: 100%; overflow: hidden; height: 600px; border: 1px solid #ddd;" cellspacing="0">
    <tr>
        <th style="padding: 5px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 55%">Descrizione</th>
        <th style="padding: 5px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 15%; text-align: right">Importo</th>
        <th style="padding: 5px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 15%; text-align: right">Quantità</th>
        <th style="padding: 5px; border-bottom: 1px solid #ddd; width: 15%; text-align: right">Totale</th>
    </tr>
    @foreach($invoice->services as $id => $service)
    <tr>
        <td style="padding: 4px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 55%">{{ $service->titolo }}</td>
        <td style="padding: 4px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 15%; text-align: right">{{ number_format($service->prezzo, 2, ',','.') }} &euro;</td>
        <td style="padding: 4px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 15%; text-align: right">1</td>
        <td style="padding: 4px; border-bottom: 1px solid #ddd; width: 15%; text-align: right">{{ number_format($service->prezzo, 2, ',','.') }} &euro;</td>
    </tr>
    @endforeach

    @for($i = $id; $i < 20; $i++)

    <tr>
        <td style="padding: 4px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 55%">&nbsp;</td>
        <td style="padding: 4px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 15%; text-align: right">&nbsp;</td>
        <td style="padding: 4px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 15%; text-align: right">&nbsp;</td>
        <td style="padding: 4px; border-bottom: 1px solid #ddd; width: 15%; text-align: right">&nbsp;</td>
    </tr>

    @endfor

    <tr>
        <td colspan="3" style="padding: 4px; text-align: right; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">Imponibile:</td>
        <td style="padding: 4px; border-bottom: 1px solid #ddd; text-align: right">{{ number_format($impo = ($invoice->totalefattura / 1.10), 2, ',','.') }} &euro;</td>
    </tr>
    <tr>
        <td colspan="3" style="padding: 4px; text-align: right; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">Iva (10%):</td>
        <td style="padding: 4px; border-bottom: 1px solid #ddd; text-align: right">{{ number_format($invoice->totalefattura - $impo, 2, ',','.') }} &euro;</td>
    </tr>
    <tr>
        <td colspan="3" style="padding: 4px; text-align: right; border-right: 1px solid #ddd; font-weight: bold; font-size: 14px;">Totale Fattura:</td>
        <td style="padding: 4px;; text-align: right">{{ number_format($invoice->totalefattura,2,',','.') }} &euro;</td>
    </tr>
</table>

<p>I dati personali del Cliente saranno trattati, in base al D.Lgs. 196/2003 e successive modificazioni,
    esclusivamente per l'erogazione del servizio e non saranno forniti a terzi o utilizzati per l'invio di pubblicità</p>


</body>
</html>