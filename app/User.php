<?php

namespace Inayat;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'surname', 'email', 'password',
        'phone', 'registration', 'firstName',
        'middleName', 'sex', 'dob', 'maritalStatus',
        'address', 'permanentAddress', 'occupation',
        'status', 'image', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
