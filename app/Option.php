<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
