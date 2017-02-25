<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
