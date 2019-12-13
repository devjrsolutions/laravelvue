<?php

namespace App\Components\Master\Models;

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
class Pasien extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'mst_pasien';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'klinik_code',
        'birthdate',
        'email',
        'phone',
        'phone_wa',
        'member_card_code',
        'advertise_code',
        'age',
        'gender_code',
        'job',
        'address',
        'photo',
        'status',
        'complain',
        'remark',
        'pasien_status_code',
        'confirm_status_code',
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
