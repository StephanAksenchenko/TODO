<?php

namespace App\Controller\Traits;

trait JsonResponseFormatterTrait
{
    public function data(mixed $data): array
    {
        return ['data' => $data];
    }

    public function error(string $error): array
    {
        return ['error' => $error];
    }
}
