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
class MemberCard extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'mst_member_card';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false; //untuk kalo lu gapake pengupdatean waktu

    protected $fillable = [
        'code',
        'company_code',
        'name',
        'member_fiture_code',
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
