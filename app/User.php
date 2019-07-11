<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToMany;
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
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Gets the user's roles
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * Checks if the user has the specified role
     *
     * @param string $roleName Name of the role to check
     *
     * @return bool true if the user has the specified role
     */
    public function hasRole(string $roleName): bool
    {
        foreach ($this->roles as $role)
        {
            if (strcmp($role->name, $roleName) == 0)
            {
                return true;
            }
        }

        return false;
    }
}
