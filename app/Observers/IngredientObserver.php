<?php

namespace App\Observers;

use App\Models\Ingredient;
use App\Services\Repositories\Contracts\HasMorphRelations;

class IngredientObserver
{
    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\Ingredient  $user
     * @return
     */
    public function deleted(Ingredient $ingredient)
    {
        return $ingredient instanceof HasMorphRelations ? $this->deleteMorphRelations($ingredient) : false;
    }

    private function deleteMorphRelations(HasMorphRelations $owner)
    {
        $relations = $owner->getMorphRelations();
        foreach ($relations as $relation) {
            $owner->{$relation}->delete();
        }
    }
}
