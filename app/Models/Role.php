<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permitions()
    {
        return $this->belongsToMany(
            Permition::class,
            'permitions_roles',
            'role_id',
            'permition_id'
        );
    }


}
