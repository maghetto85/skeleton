<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FotoRoom
 *
 * @property-read \App\Room $room
 * @mixin \Eloquent
 */
class FotoRoom extends Model
{
    protected $table = 'camere_foto';
    protected $guarded = [];
    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(Room::class, 'idcamera');
    }
}
