<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const PATH = 'path';
    const IMAGEABLE_ID = 'imageable_id';
    const IMAGEABLE_TYPE = 'imageable_type';


    /**
     * @var array
     */
    protected $fillable = [
        self::PATH,
        'is_title',
        'is_preview',
        self::IMAGEABLE_ID,
        self::IMAGEABLE_TYPE,
    ];

    /**
     * Получить все модели, обладающие imageable
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
