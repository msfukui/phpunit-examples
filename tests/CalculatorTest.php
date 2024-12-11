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

    public function testAmountOfProductUsedWillReturnCallback(): void
    {
        $api = $this->createStub(ApiGateway::class);

        $api->method('invoke')
            ->willReturnCallback(function (string $name, string $value) {
                return match ($value) {
                    'apple' => '220',
                    'banana' => '40',
                    'peach' => '420',
                    'default' => '0',
                };
            });

        $params = [
            ['name' => 'apple', 'quantity' => 3, 'expected' => 660],
            ['name' => 'banana', 'quantity' => 16, 'expected' => 640],
            ['name' => 'peach', 'quantity' => 4, 'expected' => 1680],
        ];

        foreach ($params as $param) {
            $actual = (new Calculator($api))
                ->amountOfProduct($param['name'], $param['quantity']);

            $this->assertSame($param['expected'], $actual);
        }
    }

    public function testAmountOfProductUsedWillReturnSelf()
    {
        $api = $this->createMock(ApiGateway::class);

        $api->method('invoke')
            ->willReturnSelf();

        $this->assertInstanceOf(ApiGateway::class, $api);
    }

    public function testAmountOfProductUsedWillReturnMap()
    {
        $api = $this->createMock(ApiGateway::class);

        $api->method('invoke')
            ->willReturnMap([
                ['name', 'apple', '220'],
                ['name', 'banana', '40'],
                ['name', 'peach', '420'],
            ]);

        $params = [
            ['name' => 'apple', 'quantity' => 3, 'expected' => 660],
            ['name' => 'banana', 'quantity' => 16, 'expected' => 640],
            ['name' => 'peach', 'quantity' => 4, 'expected' => 1680],
        ];

        foreach ($params as $param) {
            $actual = (new Calculator($api))
                ->amountOfProduct($param['name'], $param['quantity']);

            $this->assertSame($param['expected'], $actual);
        }
    }
}
