<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $indirizzo
 * @property string $citta
 * @property string $cap
 * @property string $provincia
 * @property string $codicefiscale
 * @property string $partitaiva
 * @property string $telefono
 * @property string $email
 * @property-read mixed $cognome_nome
 * @property-read mixed $nome_cognome
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCitta($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCodicefiscale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCognome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereIndirizzo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePartitaiva($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereProvincia($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereTelefono($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    protected $table = 'clienti';
    protected $guarded = [];
    public $timestamps = false;
    protected $appends = ['nome_cognome','cognome_nome'];

    public function getNomeCognomeAttribute()
    {
        return ucfirst(trim($this->getAttribute('nome').' '.$this->getAttribute('cognome')));
    }

    public function getCognomeNomeAttribute()
    {
        return ucfirst(trim($this->getAttribute('cognome').' '.$this->getAttribute('nome')));
    }
}
