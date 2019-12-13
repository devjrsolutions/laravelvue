<?php

namespace App\Components\Sales\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Components\User\Models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property array $permissions
 * @property string|null $active
 */
class Interaksi extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'adv_user_interaksi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company_id',
        'email',
        'phone',
        'phone_wa',
        'age',
        'advertise_id',
        'gender_code',
        'address',
        'status',
        'complain',
        'remark',
        'pasien_status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * the validation rules
     *
     * @var array
     */
    public static $rules = [];
}
