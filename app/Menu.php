<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Menu
 *
 * @property int $id
 * @property string $lang
 * @property string $titolo
 * @property string $url
 * @property int $parent
 * @property bool $position
 * @property-read \App\Locale $locale
 * @property-read \App\Menu $parentmenu
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Menu[] $submenus
 * @method static \Illuminate\Database\Query\Builder|\App\Menu whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Menu whereLang($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Menu whereParent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Menu wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Menu whereTitolo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Menu whereUrl($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    protected $guarded = [];
    protected $table = 'menu';
    public $timestamps = false;

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'lang','code');
    }

    public function parentmenu()
    {
        return $this->belongsTo(static::class, 'parent');
    }

    public function submenus()
    {
        return $this->hasMany(static::class, 'parent');
    }
}
