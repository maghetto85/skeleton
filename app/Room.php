<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function locales()
    {
        return $this->belongsToMany(Locale::class, "camera_locale", "camera_id");
    }

}