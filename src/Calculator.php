<?php

declare(strict_types=1);

namespace PHPUnitExamples;

final class Calculator
{
    public function __construct(
        private readonly ApiGateway $api,
        private readonly ApiRequest $request,
    ) {
    }

    public function amountByProduct(string $name, int $quantity): int
    {
        $this->request->set(['product_name' => $name]);
        return $this->api->invoke($this->request)->unitPrice() * $quantity;
    }
}
