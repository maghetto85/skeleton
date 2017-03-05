<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\HomeBanner
 *
 * @property int $id
 * @property string $lang
 * @property string $foto1
 * @property string $foto2
 * @property string $testo
 * @property string $testo_en
 * @property string $link
 * @property string $link_en
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Locale $locale
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereFoto1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereFoto2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereLang($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereLinkEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereTesto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereTestoEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\HomeBanner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HomeBanner extends Model
{
    protected $guarded = [];
    protected $table = "homebanner";

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'lang','code');
    }
}
