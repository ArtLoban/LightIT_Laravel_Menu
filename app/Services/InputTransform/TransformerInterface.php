<?php

namespace App\Services\InputTransform;

interface TransformerInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data);
}