<?php

namespace App\Services\Observers;

use App\Services\Observers\Contracts\MorphRelationsDeleteInterface;

class MorphRelationsDelete implements MorphRelationsDeleteInterface
{
    /**
     * @param $owner
     * @return bool
     */
    public function deleteMorphRelations($owner)
    {
        $relations = $owner->getMorphRelations();
        foreach ($relations as $relation) {
            return $owner->{$relation} ? $owner->{$relation}->delete() : false;
        }
    }

}