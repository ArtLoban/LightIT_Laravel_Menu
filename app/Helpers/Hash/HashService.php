<?php

namespace App\Helpers\Hash;

use Illuminate\Support\Facades\Hash;

class HashService implements HashServiceInterface
{
    /**
     * @param string $string
     * @return string
     */
    public function make(string $string): string
    {
        return Hash::make($string);
    }
}
