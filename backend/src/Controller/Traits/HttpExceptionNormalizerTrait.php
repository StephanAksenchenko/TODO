<?php

namespace App\Controller\Traits;

trait HttpExceptionNormalizerTrait
{
    private function normalizeHttpExceptionCode(?int $code = 400): int
    {
        if ($code >= 400 && $code < 600) {
            return $code;
        }

        return 400;
    }
}
