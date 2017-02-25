<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class AdminUser
 *
 * @package App
 * @property integer IdUtente
 * @property string NomeUtente
 * @property string Password
 * @property string Nome
 * @property string Email
 * @property Carbon DataCreazione
 * @property Carbon DataUltimoAccesso
 * @property-write mixed $password
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $primaryKey = "IdUtente";
    const CREATED_AT = 'DataCreazione';
    const UPDATED_AT = 'DataUltimoAccesso';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
