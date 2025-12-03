<?php

declare(strict_types=1);

namespace PHPUnitExamples\TestDoubles;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Calculator::class)]
final class CalculatorMockTest extends TestCase
{
    public function testAmountOfProductUsedExpectsAndWith(): void
    {
        $api = $this->createMock(ApiGateway::class);

        $api->expects($this->once())
            ->method('invoke')
            ->with(
                'name',
                'apple',
            )
            ->willReturn('220');

        (new Calculator($api))
            ->amountOfProduct('apple', 3);
    }
}
