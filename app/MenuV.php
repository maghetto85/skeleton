<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\MenuV
 *
 * @property int $id
 * @property string $lang
 * @property string $titolo
 * @property string $url
 * @property bool $position
 * @property-read \App\Locale $locale
 * @method static \Illuminate\Database\Query\Builder|\App\MenuV whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenuV whereLang($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenuV wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenuV whereTitolo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenuV whereUrl($value)
 * @mixin \Eloquent
 */
class MenuV extends Model
{
    protected $guarded = [];
    protected $table = 'menuv';
    public $timestamps = false;

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'lang','code');
    }
}
