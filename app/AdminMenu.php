<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AdminMenu
 *
 * @property int $id
 * @property string $titolo
 * @property string $url
 * @property bool $posizione
 * @property bool $visibile
 * @property \Carbon\Carbon $datacreazione
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereDatacreazione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu wherePosizione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereTitolo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminMenu whereVisibile($value)
 * @mixin \Eloquent
 */
class AdminMenu extends Model
{
    const CREATED_AT = 'datacreazione';

    protected $table = 'admin_menu';
    protected $guarded = [];

}
