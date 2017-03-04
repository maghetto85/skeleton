<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\HomeFoto
 *
 * @property int $id
 * @property string $url
 * @property string $titolo
 * @property string $titolo_en
 * @property string $link
 * @property string $link_en
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereLinkEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereTitolo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereTitoloEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeFoto whereUrl($value)
 * @mixin \Eloquent
 */
class HomeFoto extends Model
{
    protected $table = 'fotohome';
    protected $guarded = [];
    public $timestamps = false;

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'lang','code');
    }
}
