<?php

namespace App\Services\Charts\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ChartInterface
{
    /**
     * @return mixed
     */
    public function getChart(Collection $data);
}