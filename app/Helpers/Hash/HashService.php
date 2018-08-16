<?php

namespace App\Helpers\Hash;

use Illuminate\Support\Facades\Hash;

class HashService implements HashServiceInterface
{
    public function make(string $string): string
    {
        return Hash::make($string);
    }

}