<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class InvoiceService extends Model
{
    protected $table = 'fatture_servizi';
    protected $guarded = [];
    public $primaryKey = 'idfattura';
    public $timestamps = false;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'id');
    }
}
