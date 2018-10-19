<?php

namespace App\Observers;

use App\Models\User;
use App\Services\Observers\Contracts\MorphRelationsDeleteInterface;
use App\Services\Repositories\Contracts\HasMorphRelations;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * @var MorphRelationsDeleteInterface
     */
    private $service;

    /**
     * UserObserver constructor.
     * @param MorphRelationsDeleteInterface $service
     */
    public function __construct(MorphRelationsDeleteInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param User $user
     * @return bool|mixed
     */
    public function deleted(User $user)
    {
        return $user instanceof HasMorphRelations ? $this->service->deleteMorphRelations($user) : false;
    }
}
