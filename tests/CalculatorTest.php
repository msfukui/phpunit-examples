<?php

declare(strict_types=1);

namespace PHPUnitExamples;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Calculator::class)]
final class CalculatorTest extends TestCase
{
    public function testAmountOfProductUsedWillReturn(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturn("220");

        $actual = (new Calculator($api))
            ->amountOfProduct('apple', 3);

        $this->assertSame(660, $actual);
    }
}
