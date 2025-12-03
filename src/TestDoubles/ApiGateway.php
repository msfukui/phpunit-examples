<?php

declare(strict_types=1);

namespace PHPUnitExamples\TestDoubles;

interface ApiGateway
{
    /**
     * @throws NotFoundException
     */
    public function invoke(string $name, string $value): string;

    public function none(): void;

    public function unknown(): string;
}
