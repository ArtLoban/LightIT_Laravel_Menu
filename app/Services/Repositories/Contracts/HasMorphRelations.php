<?php

namespace App\Services\Repositories\Contracts;

interface HasMorphRelations
{
    /**
     * @return array
     */
    public function getMorphRelations(): array;
}
