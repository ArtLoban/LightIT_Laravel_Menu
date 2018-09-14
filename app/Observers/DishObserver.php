<?php

namespace App\Observers;

use App\Models\Dish;
use App\Services\Observers\Contracts\MorphRelationsDeleteInterface;
use App\Services\Repositories\Contracts\HasMorphRelations;

class DishObserver
{
    private $service;

    /**
     * CategoryObserver constructor.
     * @param MorphRelationsDeleteInterface $service
     */
    public function __construct(MorphRelationsDeleteInterface $service)
    {
        $this->service = $service;
    }

    public function deleted(Dish $dish)
    {
        return $dish instanceof HasMorphRelations ? $this->service->deleteMorphRelations($dish) : false;
    }
}
