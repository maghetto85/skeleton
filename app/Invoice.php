<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    protected $guarded = [];
    protected $table = 'fatture';
    public $timestamps = false;
    protected $dates = ['data'];
    protected $with = ['services'];

    public function services()
    {
        return $this->hasMany(InvoiceService::class,'idfattura');
    }

    public function prenotation()
    {
        return $this->belongsTo(Prenotation::class, 'idprenotazione');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'idcliente');
    }
}


