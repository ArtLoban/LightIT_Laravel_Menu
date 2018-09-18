<?php

namespace App\Helpers\Hash;

interface HashServiceInterface
{
    /**
     * @param string $string
     * @return string
     */
    public function make(string $string): string;
}