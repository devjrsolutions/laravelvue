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
class Advertise extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'mst_advertise';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false; //untuk kalo lu gapake pengupdatean waktu

    protected $fillable = [
        'code',
        'sort_no',
        'company_code',
        'name',
        'status',
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
