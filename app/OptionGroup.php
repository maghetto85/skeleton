<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OptionGroup
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Option[] $options
 * @method static \Illuminate\Database\Query\Builder|\App\OptionGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionGroup whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OptionGroup extends Model
{
    protected $guarded =[];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
