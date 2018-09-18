<?php
namespace App\Services\Charts;

use Illuminate\Database\Eloquent\Collection;

class TransformChartData
{
    /**
     * Transform necessary data from Collection of DishOrders into an array
     *
     * @param Collection $collection
     * @return array|null
     */
    public function transform(Collection $collection): ?array
    {
        if ($collection->isEmpty()) {
            return null;
        } else {
            $result['name'] = $collection->first()->dish->name;
            $result['quantity'] = $collection->pluck('dish_quantity')->all();
            $result['date'] = $collection
                ->pluck('created_at')
                ->map(function ($item) {
                    return $item->format('d M Y');
                })
                ->all();
        }

        return $result;
    }
}