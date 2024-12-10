<?php

declare(strict_types=1);

namespace PHPUnitExamples;

interface ApiGateway
{
    /**
     * @param array<string, string> $request
     * @return string
     */
    public function invoke(array $request): string;
}
