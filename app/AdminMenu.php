<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AdminMenu
 *
 * @mixin \Eloquent
 */
class AdminMenu extends Model
{
    const CREATED_AT = 'datacreazione';

    protected $table = 'admin_menu';
    protected $guarded = [];

}
