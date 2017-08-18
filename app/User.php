<?php

namespace Inayat;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ACTIVE = 1;

    protected $dummyImage = __DIR__ . '../public/image/avatar.jpg';

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
     * Check if role is SuperAdmin
     *
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->attributes['role'] == Role::DEVELOPER;
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
        return $this->hasOne('Inayat\Kin');
    }

    /**
     * One to Many Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function account()
    {
        return $this->hasMany('Inayat\Account');
    }

    /**
     * Get the avatar from gravatar.
     *
     * @return string
     */
    private function getAvatarFromGravatar()
    {
        return 'http://www.gravatar.com/avatar/'.md5(strtolower(trim($this->email))).'?d=mm&s=500';
    }

    /**
     * Get avatar from the model.
     *
     * @return string
     */
    public function getAvatar()
    {
        return (! is_null($this->image)) ? $this->image : $this->getAvatarFromGravatar();
    }

    /**
     * update users Avatar.
     *
     * @param  file
     *
     * @return void
     */
    public function updateAvatar($img)
    {
        $this->image = $img;

        $this->save();
    }
}
