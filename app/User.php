<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function loginCredentials()
    {
        return $this->hasOne('App\UserLogin');
    }

    public function role()
    {
        return $this->hasOne('App\UserRole');
    }

    public function supplier()
    {
        return $this->hasOne('App\Supplier');
    }

    public function courier()
    {
        return $this->hasOne('App\Courier');
    }
}
