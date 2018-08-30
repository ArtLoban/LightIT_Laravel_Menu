<?php

namespace App\Observers;

use App\Models\User;
use App\Services\Repositories\Contracts\HasMorphRelations;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return
     */
    public function deleted(User $user)
    {
        return $user instanceof HasMorphRelations ? $this->deleteMorphRelations($user) : false;
    }

    private function deleteMorphRelations(HasMorphRelations $owner)
    {
        $relations = $owner->getMorphRelations();
        foreach ($relations as $relation) {
            return $owner->{$relation} ? $owner->{$relation}->delete() : false;
        }
    }
}