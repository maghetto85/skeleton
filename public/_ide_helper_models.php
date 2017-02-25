<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\AdminMenu
 *
 * @property int $id
 * @property string $titolo
 * @property string $url
 * @property bool $posizione
 * @property bool $visibile
 * @property \Carbon\Carbon $datacreazione
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereDatacreazione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu wherePosizione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereTitolo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereVisibile($value)
 */
	class AdminMenu extends \Eloquent {}
}

namespace App{
/**
 * App\AdminUser
 *
 * @property int $IdUtente
 * @property string $NomeUtente
 * @property mixed $password
 * @property string $Nome
 * @property string $email
 * @property string $remember_token
 * @property \Carbon\Carbon $DataCreazione
 * @property \Carbon\Carbon $DataUltimoAccesso
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereDataCreazione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereDataUltimoAccesso($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereIdUtente($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereNomeUtente($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereRememberToken($value)
 */
	class AdminUser extends \Eloquent {}
}

namespace App{
/**
 * App\Customer
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $indirizzo
 * @property string $citta
 * @property string $cap
 * @property string $provincia
 * @property string $codicefiscale
 * @property string $partitaiva
 * @property string $telefono
 * @property string $email
 * @property-read mixed $nome_cognome
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCitta($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCodicefiscale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCognome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereIndirizzo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePartitaiva($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereProvincia($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereTelefono($value)
 */
	class Customer extends \Eloquent {}
}

namespace App{
/**
 * App\FotoRoom
 *
 * @property int $idcamera
 * @property bool $idfoto
 * @property string $url
 * @property string $miniatura
 * @property bool $posizione
 * @property bool $visibile
 * @property-read \App\Room $room
 * @method static \Illuminate\Database\Query\Builder|\App\FotoRoom whereIdcamera($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FotoRoom whereIdfoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FotoRoom whereMiniatura($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FotoRoom wherePosizione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FotoRoom whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FotoRoom whereVisibile($value)
 */
	class FotoRoom extends \Eloquent {}
}

namespace App{
/**
 * App\HomeFoto
 *
 * @property int $id
 * @property string $url
 * @property string $titolo
 * @property string $titolo_en
 * @property string $link
 * @property string $link_en
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereLinkEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereTitolo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereTitoloEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereUrl($value)
 */
	class HomeFoto extends \Eloquent {}
}

namespace App{
/**
 * App\Invoice
 *
 * @property int $id
 * @property int $numero
 * @property \Carbon\Carbon $data
 * @property int $idcliente
 * @property int $idprenotazione
 * @property float $costocamera
 * @property float $totalefattura
 * @property string $Nome
 * @property string $Indirizzo
 * @property string $Cap
 * @property string $Citta
 * @property string $Provincia
 * @property string $PartitaIva
 * @property string $CodiceFiscale
 * @property-read \App\Prenotation $prenotation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InvoiceService[] $services
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCitta($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCodiceFiscale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCostocamera($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereIdcliente($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereIdprenotazione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereIndirizzo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereNumero($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice wherePartitaIva($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereProvincia($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTotalefattura($value)
 */
	class Invoice extends \Eloquent {}
}

namespace App{
/**
 * App\InvoiceService
 *
 * @property int $idfattura
 * @property bool $row
 * @property string $titolo
 * @property float $prezzo
 * @property-read \App\Invoice $invoice
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceService whereIdfattura($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceService wherePrezzo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceService whereRow($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceService whereTitolo($value)
 */
	class InvoiceService extends \Eloquent {}
}

namespace App{
/**
 * App\Locale
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereUpdatedAt($value)
 */
	class Locale extends \Eloquent {}
}

namespace App{
/**
 * App\Option
 *
 * @property int $Id
 * @property int $option_group_id
 * @property string $type
 * @property string $slug
 * @property string $name
 * @property string $value
 * @property-read \App\OptionGroup $group
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereOptionGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereValue($value)
 */
	class Option extends \Eloquent {}
}

namespace App{
/**
 * App\OptionGroup
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Option[] $options
 * @method static \Illuminate\Database\Query\Builder|\App\OptionGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionGroup whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionGroup whereUpdatedAt($value)
 */
	class OptionGroup extends \Eloquent {}
}

namespace App{
/**
 * App\Prenotation
 *
 * @property int $id
 * @property int $idcliente
 * @property int $idcamera
 * @property bool $stato
 * @property bool $origine
 * @property string $DataInserimento
 * @property string $Nome
 * @property string $Cognome
 * @property string $Telefono
 * @property string $Email
 * @property \Carbon\Carbon $DataArrivo
 * @property string $checkin
 * @property \Carbon\Carbon $DataPartenza
 * @property bool $NrAdulti
 * @property bool $NrBambini
 * @property string $Note
 * @property float $acconto
 * @property float $totale
 * @property float $totale_prenotazione
 * @property float $totale_versato
 * @property float $acconto_versato
 * @property float $saldo_versato
 * @property bool $stato_pagamento_acconto
 * @property \Carbon\Carbon $data_pagamento_acconto
 * @property bool $stato_pagamento_saldo
 * @property \Carbon\Carbon $data_pagamento_saldo
 * @property bool $tipo_pagamento
 * @property bool $stato_pagamento
 * @property \Carbon\Carbon $DataPagamento
 * @property-read mixed $cognome
 * @property-read mixed $data_arrivo
 * @property-read mixed $data_inserimento
 * @property-read mixed $data_partenza
 * @property-read mixed $giorno_arrivo
 * @property-read mixed $giorno_partenza
 * @property-read mixed $name
 * @property-read mixed $nome
 * @property-read mixed $status
 * @property-read \App\Invoice $invoice
 * @property-read \App\Room $room
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation day($date)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereAcconto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereAccontoVersato($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereCheckin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereCognome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereDataArrivo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereDataInserimento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereDataPagamento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereDataPagamentoAcconto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereDataPagamentoSaldo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereDataPartenza($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereIdcamera($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereIdcliente($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereNrAdulti($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereNrBambini($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereOrigine($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereSaldoVersato($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereStato($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereStatoPagamento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereStatoPagamentoAcconto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereStatoPagamentoSaldo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereTelefono($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereTipoPagamento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereTotale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereTotalePrenotazione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation whereTotaleVersato($value)
 */
	class Prenotation extends \Eloquent {}
}

namespace App{
/**
 * App\PrenotationStatus
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereUpdatedAt($value)
 */
	class PrenotationStatus extends \Eloquent {}
}

namespace App{
/**
 * App\Room
 *
 * @property int $id
 * @property string $titolo
 * @property string $descrizione
 * @property string $descrizione_en
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FotoRoom[] $pics
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Prenotation[] $prenotations
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereDescrizione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereDescrizioneEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereTitolo($value)
 */
	class Room extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

