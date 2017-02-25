<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    protected $guarded =[];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
