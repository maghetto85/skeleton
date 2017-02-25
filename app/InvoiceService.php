<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
