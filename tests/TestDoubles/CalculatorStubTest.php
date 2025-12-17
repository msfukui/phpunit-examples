<?php

declare(strict_types=1);

namespace PHPUnitExamples\TestDoubles;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[CoversClass(Calculator::class)]
final class CalculatorStubTest extends TestCase
{
    public function testAmountOfProductUsedCreateConfiguredStub(): void
    {
        $api = $this->createConfiguredStub(
            ApiGateway::class,
            [
                'invoke' => '220',
            ]
        );

        $this->assertSame(
            660,
            (new Calculator($api))
                ->amountOfProduct('apple', 3)
        );
    }

    public function testAmountOfProductUsedWillReturn(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturn('220');

        $this->assertSame(
            660,
            (new Calculator($api))
                ->amountOfProduct('apple', 3)
        );
    }

    public function testAmountOfProductUsedWillReturns(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturn('220', '40', '420');

        $this->assertSame(
            660,
            (new Calculator($api))
                ->amountOfProduct('apple', 3)
        );

        $this->assertSame(
            640,
            (new Calculator($api))
                ->amountOfProduct('banana', 16)
        );

        $this->assertSame(
            1680,
            (new Calculator($api))
                ->amountOfProduct('peach', 4)
        );
    }

    public function testAmountOfProductUsedWillThrowException(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willThrowException(new NotFoundException());

        $this->expectException(NotFoundException::class);

        (new Calculator($api))
            ->amountOfProduct('grape', 5);
    }

    public function testAmountOfProductUsedWillReturnArgument(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturnArgument(1);

        $this->assertSame(
            1260,
            (new Calculator($api))
                ->amountOfProduct('420', 3)
        );
    }

    #[TestWith(['apple', 3, 660])]
    #[TestWith(['banana', 16, 640])]
    #[TestWith(['peach', 4, 1680])]
    public function testAmountOfProductUsedWillReturnCallback(string $productName, int $quantity, int $expected): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturnCallback(function (string $name, string $value) {
                return match ($value) {
                    'apple' => '220',
                    'banana' => '40',
                    'peach' => '420',
                    default => throw new NotFoundException(),
                };
            });

        $actual = (new Calculator($api))
            ->amountOfProduct($productName, $quantity);

        $this->assertSame($expected, $actual);
    }

    #[TestWith(['apple', 3, 660])]
    #[TestWith(['banana', 16, 640])]
    #[TestWith(['peach', 4, 1680])]
    public function testAmountOfProductUsedWillReturnMap(string $productName, int $quantity, int $expected)
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturnMap([
                ['name', 'apple', '220'],
                ['name', 'banana', '40'],
                ['name', 'peach', '420'],
            ]);

        $actual = (new Calculator($api))
            ->amountOfProduct($productName, $quantity);

        $this->assertSame($expected, $actual);
    }

    #[DoesNotPerformAssertions]
    public function testAmountOfProductReturnVoid(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->none();
    }

    public function testAmountOfProductInvalidArgumentException(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturn('not a number');

        $this->expectException(InvalidArgumentException::class);

        (new Calculator($api))
            ->amountOfProduct('apple', 3);
    }

    public function testAmountOfProductUsedWillReturnWithDoubleMethods(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturn('220');

        $api->method('unknown')
            ->willReturn('known');

        $this->assertSame('220', $api->invoke('name', 'apple'));

        $this->assertSame('known', $api->unknown());
    }
}
