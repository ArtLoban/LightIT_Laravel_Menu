<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\Observers\Contracts\MorphRelationsDeleteInterface;
use App\Services\Observers\MorphRelationsDelete;
use App\Services\Repositories\Contracts\HasMorphRelations;

class CategoryObserver
{
    /**
     * @param Category $category
     * @return bool
     */
    public function deleted(Category $category)
    {
        return $category instanceof HasMorphRelations ? $this->deleteMorphRelations($category) : false;
    }

    private function deleteMorphRelations(HasMorphRelations $owner)
    {
        $relations = $owner->getMorphRelations();
        foreach ($relations as $relation) {
            return $owner->{$relation} ? $owner->{$relation}->delete() : false;
        }
    }

    /*public function deleted(Category $category, MorphRelationsDeleteInterface $service)
    {
        return $category instanceof HasMorphRelations ? $service->deleteMorphRelations($category) : false;
    }*/

}
