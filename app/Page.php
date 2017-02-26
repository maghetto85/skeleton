<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Page
 *
 * @property int $Id
 * @property string $lang
 * @property string $Slug
 * @property string $Titolo
 * @property string $Contenuto
 * @property-read \App\Locale $locale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PagePicture[] $pictures
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereContenuto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereLang($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereTitolo($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    protected $guarded = [];
    protected $table = "pagine";
    public $timestamps = false;
    protected $primaryKey = "Id";

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'lang','code');
    }

    public function pictures()
    {
        return $this->hasMany(PagePicture::class, "IdPagina", "Id");
    }

}
