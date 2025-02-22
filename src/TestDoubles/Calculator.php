<?php

declare(strict_types=1);

namespace PHPUnitExamples\TestDoubles;

use InvalidArgumentException;
use PHPUnitExamples\TestDoubles\ApiGateway;
use PHPUnitExamples\TestDoubles\NotFoundException;

final class Calculator
{
    public function __construct(
        private readonly ApiGateway $api,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function amountOfProduct(string $name, int $quantity): int
    {
        $priceString = $this->api->invoke('name', $name);

        if (is_numeric($priceString) === false) {
            throw new InvalidArgumentException('Price must be a number, but ' . $priceString);
        }

        $unitPrice = intval($priceString);

        return $this->amount($unitPrice, $quantity);
    }

    private function amount(int $unitPrice, int $quantity): int
    {
        return $unitPrice * $quantity;
    }
}
