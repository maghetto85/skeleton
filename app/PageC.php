<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PageC
 *
 * @property int $id
 * @property string $lang
 * @property string $slug
 * @property string $titolo
 * @property-read \App\Locale $locale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PageParagraph[] $paragraphs
 * @method static \Illuminate\Database\Query\Builder|\App\PageC whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PageC whereLang($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PageC whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PageC whereTitolo($value)
 * @mixin \Eloquent
 */
class PageC extends Model
{
    protected $guarded = [];
    protected $table = "paginec";
    public $timestamps = false;
    protected $primaryKey = "id";

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'lang','code');
    }

    public function paragraphs()
    {
        return $this->hasMany(PageParagraph::class, 'idpagina');
    }

}
