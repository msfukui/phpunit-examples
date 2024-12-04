<?php

declare(strict_types=1);

namespace PHPUnitExamples;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

#[CoversClass(Calculator::class)]
class CalculatorTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountByProduct(): void
    {
        $response = $this->createStub(ApiResponse::class);
        $response->method('unitPrice')
            ->willReturn(220);

        $api = $this->createStub(ApiGateway::class);
        $api->method('invoke')
            ->willReturn($response);

        $request = $this->createStub(ApiRequest::class);

        $this->assertSame(
            660,
            (new Calculator($api, $request))->amountByProduct('apple', 3)
        );
    }
}
