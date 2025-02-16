<?php

declare(strict_types=1);

namespace PHPUnitExamples\ByPassFinals;

use DG\BypassFinals;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(FinalClass::class)]
final class FinalClassTest extends TestCase
{
    private FinalClass $mock;

    public function testGetSomething()
    {
        $this->assertSame('mockedValue', $this->mock->getSomething());
    }

    protected function setUp(): void
    {
        BypassFinals::enable();

        $this->mock = $this->createMock(FinalClass::class);
        $this->mock
            ->method('getSomething')
            ->willReturn('mockedValue');
    }
}
