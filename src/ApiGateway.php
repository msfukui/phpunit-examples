<?php

declare(strict_types=1);

namespace PHPUnitExamples;

interface ApiGateway
{
    public function invoke(ApiRequest $request): ApiResponse;
}
