<?php

declare(strict_types=1);

namespace PHPUnitExamples\ByPassFinals;

final class FinalClass
{
    public function getSomething(): string
    {
        return 'originalValue';
    }
}
