<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Guest
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property string $datanascita
 * @property string $cittadinanza
 * @property string $luogonascita
 * @property string $tipodocumento
 * @property string $nrdocumento
 * @property string $datarilascio
 * @property string $datascadenza
 * @property string $luogorilascio
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereCittadinanza($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereCognome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereDatanascita($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereDatarilascio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereDatascadenza($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereLuogonascita($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereLuogorilascio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereNrdocumento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Guest whereTipodocumento($value)
 * @mixin \Eloquent
 */
class Guest extends Model
{
    protected $table = "ospiti";
    protected $dates = ['datanascita','datarilascio','datascadenza'];
    protected $guarded = [];
    public $timestamps = false;
}
