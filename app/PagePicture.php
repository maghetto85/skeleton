<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PagePicture
 *
 * @property int $IdFoto
 * @property int $IdPagina
 * @property string $Url
 * @property string $Miniatura
 * @property bool $Posizione
 * @property-read \App\Page $page
 * @method static \Illuminate\Database\Query\Builder|\App\PagePicture whereIdFoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PagePicture whereIdPagina($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PagePicture whereMiniatura($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PagePicture wherePosizione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PagePicture whereUrl($value)
 * @mixin \Eloquent
 */
class PagePicture extends Model
{
    protected $primaryKey = "IdFoto";
    protected $table = "pagine_foto";
    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo(Page::class, "IdPagina");
    }
}
