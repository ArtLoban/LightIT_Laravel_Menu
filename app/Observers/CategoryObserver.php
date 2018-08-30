<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\Repositories\Contracts\HasMorphRelations;

class CategoryObserver
{
    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\MOdels\Category  $category
     * @return
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
}
