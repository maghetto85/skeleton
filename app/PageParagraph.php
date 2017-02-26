<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PageParagraph
 *
 * @property int $id
 * @property int $idpagina
 * @property string $titolo
 * @property string $foto
 * @property string $descrizione
 * @property bool $posizione
 * @property-read \App\PageC $page
 * @method static \Illuminate\Database\Query\Builder|\App\PageParagraph whereDescrizione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PageParagraph whereFoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PageParagraph whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PageParagraph whereIdpagina($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PageParagraph wherePosizione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PageParagraph whereTitolo($value)
 * @mixin \Eloquent
 */
class PageParagraph extends Model
{
    protected $guarded = [];
    protected $table = "paginec_paragrafi";
    public $timestamps = false;
    protected $primaryKey = "id";

    public function page()
    {
        return $this->belongsTo(PageC::class, 'idpagina');
    }

}
