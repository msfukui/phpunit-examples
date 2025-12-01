<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use DG\BypassFinals;

BypassFinals::enable();
BypassFinals::allowPaths([
    '*/tests/*',
    '*/src/*',
]);
