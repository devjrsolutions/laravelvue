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
class PasienMember extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'mst_pasien_member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false; //untuk kalo lu gapake pengupdatean waktu

    protected $fillable = [
        'code',
        'name',
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
        'create_by',
        'create_date',
        'confirm_by',
        'confirm_date',
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
