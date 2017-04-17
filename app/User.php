<?php

namespace Inayat;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ACTIVE = 1;

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

    /**
     * Check if logged in user is Admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->attributes['role'] != Role::MEMBER;
    }

    /**
     * Get User's fullName
     *
     * @return string
     */
    public function fullName()
    {
        return $this->getAttribute('firstName') . ' ' . $this->getAttribute('surname');
    }

    public function kins()
    {
        return $this->hasOne('Inayat\Role');
    }
}
