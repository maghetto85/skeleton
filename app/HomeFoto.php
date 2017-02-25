<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\HomeFoto
 *
 * @mixin \Eloquent
 */
class HomeFoto extends Model
{
    protected $table = 'fotohome';
    protected $guarded = [];
    public $timestamps = false;

}
