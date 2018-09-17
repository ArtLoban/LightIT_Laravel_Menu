<?php

namespace App\Observers;

use App\Models\Dish;
use App\Services\Observers\Contracts\MorphRelationsDeleteInterface;
use App\Services\Repositories\Contracts\HasMorphRelations;

class DishObserver
{
    /**
     * @var MorphRelationsDeleteInterface
     */
    private $service;

    /**
     * DishObserver constructor.
     * @param MorphRelationsDeleteInterface $service
     */
    public function __construct(MorphRelationsDeleteInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Dish $dish
     * @return bool|mixed
     */
    public function deleted(Dish $dish)
    {
        return $dish instanceof HasMorphRelations ? $this->service->deleteMorphRelations($dish) : false;
    }
}
