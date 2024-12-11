<?php

declare(strict_types=1);

namespace PHPUnitExamples;

interface ApiGateway
{
    /**
     * @throws NotFoundException
     */
    public function invoke(string $name, string $value): string;
}
