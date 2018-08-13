<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permition extends Model
{
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'permitions_roles',
            'permition_id',
            'role_id'
        );
    }
}
