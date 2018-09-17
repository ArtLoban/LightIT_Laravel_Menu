<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\Observers\Contracts\MorphRelationsDeleteInterface;
use App\Services\Repositories\Contracts\HasMorphRelations;

class CategoryObserver
{
    /**
     * @var MorphRelationsDeleteInterface
     */
    private $service;

    /**
     * CategoryObserver constructor.
     * @param MorphRelationsDeleteInterface $service
     */
    public function __construct(MorphRelationsDeleteInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Category $category
     * @return bool|mixed
     */
    public function deleted(Category $category)
    {
        return $category instanceof HasMorphRelations ? $this->service->deleteMorphRelations($category) : false;
    }
}
