<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Emailtemplate
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Emailtemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Emailtemplate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Emailtemplate whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Emailtemplate whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Emailtemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Emailtemplate extends Model
{
    protected $guarded = [];
}
