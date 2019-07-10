<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * Gets the all users that have this role
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
