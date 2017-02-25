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
}
