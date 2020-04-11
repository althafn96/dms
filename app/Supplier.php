<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
