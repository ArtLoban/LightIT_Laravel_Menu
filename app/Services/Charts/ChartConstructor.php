<?php

namespace App\Services\Charts;

use App\Services\Charts\Contracts\ChartInterface;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class ChartConstructor extends Chart implements ChartInterface
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getChart($dishOrderData)
    {
//        $this->labels(['One', 'Two', 'Three', 'Four', 'Five']);
//        $this->dataset('Блюдо 1', 'line', [100, 65, 84, 45, 90])->color('red')->fill(false);
//        $this->dataset('Блюдо 2', 'line', [25, 15, 84, 90, 50])->color('blue')->fill(false);
//        $this->dataset('Блюдо 3', 'line', [5, 35, 51, 70, 25])->color('green')->fill(false);

        $this->labels($dishOrderData['date']);
        $this->dataset($dishOrderData['name'], 'line', $dishOrderData['quantity'])->color('red')->fill(false);

        return $this;
    }
}
