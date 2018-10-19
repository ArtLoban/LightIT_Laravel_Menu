<?php

namespace App\Services\Charts;

use App\Helpers\ColorPicker\ColorPickerInterface;
use App\Services\Charts\Contracts\ChartInterface;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Database\Eloquent\Collection;

class ChartConstructor extends Chart implements ChartInterface
{
    /**
     * Array of 20 HTML color names
     *
     * @var array
     */
    private $colors;

    /**
     * @var \App\Services\Charts\TransformChartData
     */
    private $dataTransformer;

    /**
     * ChartConstructor constructor.
     * @param ColorPickerInterface $colors
     * @param \App\Services\Charts\TransformChartData $dataTransformer
     */
    public function __construct(ColorPickerInterface $colors, TransformChartData $dataTransformer)
    {
        parent::__construct();
        $this->colors = $colors->getColors();
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * @param Collection $collection
     * @return ChartConstructor
     */
    public function getChart(Collection $collection): ChartConstructor
    {
        $data = $this->dataTransformer->transform($collection);

        if (is_null($data)) {
            $this->showFakeTrand();
        } else {
            $this->labels($data['date']);
            $this->dataset($data['name'], 'line', $data['quantity'])
                ->color($this->colors[0])
                ->fill(false);
        }

        return $this;
    }

    /**
     * Returns ChartConstructor object with fake data in case when no data is available
     *
     * @return $this
     */
    private function showFakeTrand(): ChartConstructor
    {
        $this->labels([0, 1, 2, 3, 4, 5]);
        $this->dataset('trand', 'line', [0, 1, 2, 3, 4, 5])
            ->color($this->colors[0])
            ->fill(false);

        return $this;
    }
}
