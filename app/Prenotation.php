<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
 * @mixin \Eloquent
 */
class Prenotation extends Model
{
    protected $table = 'prenotazioni';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = ['DataPartenza','DataArrivo','data_pagamento_acconto','data_pagamento_saldo','DataPagamento','name'];
    public $appends = ['DataPartenza','DataArrivo','Nome','Cognome','name'];
    const CREATED_AT = 'DataInserimento';

    public function getNameAttribute()
    {
        $arrivo = $this->getAttribute('DataArrivo');
        $partenza = $this->getAttribute('DataPartenza');
        $camera = $this->room->titolo;

        return "$camera ($arrivo - $partenza)";

    }

    public function toJson($options = 0)
    {
        if($this->totale) $this->totale = number_format($this->totale, 2);
        return parent::toJson($options); // TODO: Change the autogenerated stub
    }


    public function getNomeAttribute()
    {
        return ucwords(strtolower($this->getAttributeFromArray('Nome')));
    }

    public function getCognomeAttribute()
    {
        return ucwords(strtolower($this->getAttributeFromArray('Cognome')));
    }

    public function getGiornoPartenzaAttribute()
    {
        return $this->getAttributeFromArray('DataPartenza') ? (new Carbon($this->getAttributeFromArray('DataPartenza')))->toDateString() : null;
    }

    public function getGiornoArrivoAttribute()
    {
        return $this->getAttributeFromArray('DataArrivo') ? (new Carbon($this->getAttributeFromArray('DataArrivo')))->toDateString() : null;
    }

    public function getDataInserimentoAttribute()
    {
        return $this->getAttributeFromArray('DataInserimento') ? (new Carbon($this->getAttributeFromArray('DataInserimento')))->format('d/m/Y H:i') : null;
    }
    
    public function getDataPartenzaAttribute()
    {
        return $this->getAttributeFromArray('DataPartenza') ? (new Carbon($this->getAttributeFromArray('DataPartenza')))->format('d/m/Y') : null;
    }

    public function getDataArrivoAttribute()
    {
        return $this->getAttributeFromArray('DataArrivo') ? (new Carbon($this->getAttributeFromArray('DataArrivo')))->format('d/m/Y') : null;
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'idcamera');
    }

    public function scopeDay(Builder $query, $date)
    {
        $query->whereRaw('? BETWEEN DataArrivo AND DataPartenza',[$date]);
    }

    public function getStatusAttribute()
    {
        $status = new \stdClass();
        $status->status = $this->stato;

        switch ($this->stato) {
            case PRENOT_DACONFERMARE:
                if($this->origine == PRENOT_ORIG_WEB) {
                    $status->class = 'daconfermareweb';
                    $status->name = 'Da Confermare (Web)';
                } else {
                    $status->class = 'daconfermare';
                    $status->name = 'Da Confermare';
                }
                break;

           default:
               $status->class = 'confermata';
               $status->name = 'Confermata';
               if($this->origine == PRENOT_ORIG_WEB) $status->name.= ' (Web)';
        }

        return $status;

    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class,'idprenotazione');
    }

}
