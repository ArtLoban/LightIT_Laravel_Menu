<?php

namespace App\Observers;

use App\Models\Ingredient;
use App\Services\Observers\Contracts\MorphRelationsDeleteInterface;
use App\Services\Repositories\Contracts\HasMorphRelations;

class IngredientObserver
{
    /**
     * @var MorphRelationsDeleteInterface
     */
    private $service;

    /**
     * IngredientObserver constructor.
     * @param MorphRelationsDeleteInterface $service
     */
    public function __construct(MorphRelationsDeleteInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Ingredient $ingredient
     * @return bool
     */
    public function deleted(Ingredient $ingredient)
    {
        return $ingredient instanceof HasMorphRelations ? $this->service->deleteMorphRelations($ingredient) : false;
    }
}
