<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Prenotation
 *
 * @property-read mixed $data_partenza
 * @property-read mixed $data_arrivo
 * @property-read \App\Room $room
 * @property-read $status
 * @method static \Illuminate\Database\Query\Builder|\App\Prenotation day($date)
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
