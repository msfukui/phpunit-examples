<?php

declare(strict_types=1);

namespace PHPUnitExamples\TestDoubles;

use InvalidArgumentException;

final readonly class Calculator
{
    public function __construct(
        private ApiGateway $api,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function amountOfProduct(string $name, int $quantity): int
    {
        $priceString = $this->invoke('name', $name);

        if (is_numeric($priceString) === false) {
            throw new InvalidArgumentException('Price must be a number, but ' . $priceString);
        }

        $unitPrice = intval($priceString);

        return $this->amount($unitPrice, $quantity);
    }

    /**
     * @throws NotFoundException
     */
    public function invoke(string $name, string $value): string
    {
        return $this->api->invoke($name, $value);
    }

    private function amount(int $unitPrice, int $quantity): int
    {
        return $unitPrice * $quantity;
    }
}
