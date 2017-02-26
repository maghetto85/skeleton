<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\AdminUser
 *
 * @property int $IdUtente
 * @property string $NomeUtente
 * @property mixed $password
 * @property string $Nome
 * @property string $email
 * @property string $remember_token
 * @property \Carbon\Carbon $DataCreazione
 * @property \Carbon\Carbon $DataUltimoAccesso
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereDataCreazione($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereDataUltimoAccesso($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereIdUtente($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereNome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereNomeUtente($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdminUser whereRememberToken($value)
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
