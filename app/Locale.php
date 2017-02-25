<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $guarded = [];
    protected $appends = ['flag'];

    public function getFlagAttribute()
    {
        $code = $this->getAttribute('code');
        return "http://www.halex.it/img/flags/{$code}.png";
    }

}
