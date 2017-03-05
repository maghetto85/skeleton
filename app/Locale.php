<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Locale
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $flag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HomeBanner[] $homebanner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HomeFoto[] $homefoto
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MenuV[] $menuv
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Locale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Locale extends Model
{
    protected $guarded = [];
    protected $appends = ['flag'];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function getFlagAttribute()
    {
        $code = $this->getAttribute('code');
        return "http://www.halex.it/img/flags/{$code}.png";
    }

    public function homefoto()
    {
        return $this->hasMany(HomeFoto::class, 'lang','code');
    }

    public function homebanner()
    {
        return $this->hasMany(HomeBanner::class, 'lang','code');
    }

    public function menuv()
    {
        return $this->hasMany(MenuV::class, 'lang','code');
    }


}
