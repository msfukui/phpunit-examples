<?php

declare(strict_types=1);

namespace PHPUnitExamples;

final class Calculator
{
    public function add(int $a, int $b): int
    {
        return $a + $b;
    }
}
