<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Room
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Prenotation[] $prenotations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FotoRoom[] $pics
 * @mixin \Eloquent
 */
class Room extends Model
{
    protected $table = 'camere';
    protected $guarded = [];
    public $timestamps = false;

    public function prenotations()
    {
        return $this->hasMany(Prenotation::class, 'idcamera');
    }

    public function pics()
    {
        return $this->hasMany(FotoRoom::class, 'idcamera');
    }
}
