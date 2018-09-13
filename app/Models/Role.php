<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const EDITOR_ID = 1;
    const ADMIN_ID = 2;
    const SUPER_ADMIN_ID = 3;
    const CUSTOMER_ID = 4;

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_role',
            'role_id',
            'permission_id'
        );
    }
}
