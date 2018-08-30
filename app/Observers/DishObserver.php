<?php

namespace App\Observers;

use App\Models\Dish;
use App\Services\Repositories\Contracts\HasMorphRelations;

class DishObserver
{
    /**
     * Handle the dish "deleted" event.
     *
     * @param  \App\MOdels\Dish  $dish
     * @return
     */
    public function deleted(Dish $dish)
    {
        return $dish instanceof HasMorphRelations ? $this->deleteMorphRelations($dish) : false;
    }

    private function deleteMorphRelations(HasMorphRelations $owner)
    {
        $relations = $owner->getMorphRelations();
        foreach ($relations as $relation) {
            return $owner->{$relation} ? $owner->{$relation}->delete() : false;
        }
    }
}
