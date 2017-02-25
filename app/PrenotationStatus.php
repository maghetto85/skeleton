<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PrenotationStatus
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PrenotationStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrenotationStatus extends Model
{
    protected $table = "prenotation_status";
}
