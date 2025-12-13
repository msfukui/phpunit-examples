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

    public function testAmountOfProductUsedExpectsAndWithConstraints(): void
    {
        $api = $this->createMock(ApiGateway::class);

        $api->expects($this->once())
            ->method('invoke')
            ->with(
                $this->identicalTo('name'),
                $this->stringContains('apple'),
            )
            ->willReturn('220');

        (new Calculator($api))
            ->amountOfProduct('apple', 3);
    }

    public function testAmountOfProductUsedPartialMock(): void
    {
        $calculator = $this->createPartialMock(Calculator::class, ['invoke']);

        $calculator->expects($this->any())
            ->method('invoke')
            ->with(
                $this->identicalTo('name'),
                $this->stringContains('banana'),
            )
            ->willReturn('40');

        $calculator
            ->amountOfProduct('banana', 16);
    }
}
