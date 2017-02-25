<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Option
 *
 * @property int $Id
 * @property int $option_group_id
 * @property string $type
 * @property string $slug
 * @property string $name
 * @property string $value
 * @property-read \App\OptionGroup $group
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereOptionGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Option whereValue($value)
 * @mixin \Eloquent
 */
class Option extends Model
{
    protected $guarded = [];
    protected $primaryKey = "Id";
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(OptionGroup::class);
    }
}
