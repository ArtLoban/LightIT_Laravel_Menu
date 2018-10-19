<?php

namespace App\Helpers\ColorPicker;

class ColorPicker implements ColorPickerInterface
{
    /**
     * Return the array of 20 HTML Color Names supported by all browsers
     *
     * @return array
     */
    public function getColors(): array
    {
        return [
          'Blue',
          'BlueViolet',
          'Brown',
          'CornflowerBlue',
          'DarkGoldenRod',
          'DarkGreen',
          'DarkSalmon',
          'DarkSlateGray',
          'Aqua',
          'DeepPink',
          'Gold',
          'Green',
          'LawnGreen',
          'LightCoral',
          'LightSeaGreen',
          'MediumOrchid',
          'MidnightBlue',
          'Navy',
          'OrangeRed',
          'Red',
        ];
    }
}
