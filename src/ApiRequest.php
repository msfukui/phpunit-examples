<?php

declare(strict_types=1);

namespace PHPUnitExamples;

interface ApiRequest
{
    public function set(array $data): void;
}
