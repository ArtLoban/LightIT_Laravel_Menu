<?php

namespace App\Helpers\Hash;

interface HashServiceInterface
{
    public function make(string $string): string;
}