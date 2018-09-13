<?php

namespace App\Services\Observers\Contracts;

interface MorphRelationsDeleteInterface
{
    /**
     * @return mixed
     */
    public function deleteMorphRelations($owner);
}