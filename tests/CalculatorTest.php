<?php

declare(strict_types=1);

namespace PHPUnitExamples;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Calculator::class)]
class CalculatorTest extends TestCase
{
    public function testAdd(): void
    {
        $this->assertSame(
            3,
            (new Calculator())->add(1, 2)
        );
    }
}
