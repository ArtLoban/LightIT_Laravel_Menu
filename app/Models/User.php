<?php

namespace App\Models;

use App\Models\Order\Order;
use App\Services\Image\Contracts\HasImage;
use App\Services\Repositories\Contracts\HasMorphRelations;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasImage, HasMorphRelations
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number','password', 'role_id'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all images of user
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    /**
     * @return mixed
     */
    public function getAllPermissions()
    {
        return $this->role()
            ->with('permissions')
            ->get()
            ->first()
            ->permissions;
    }

    /**
     * @return Image|mixed|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function ownerType(): string
    {
        return get_class($this);
    }

    /**
     * @return int
     */
    public function ownerId(): int
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getMorphRelations(): array
    {
        return [
            'image'
        ];
    }
}
