<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
