<?php

declare(strict_types=1);

namespace Quillstack\ParameterBag\Tests\DataProviders;

use Quillstack\UnitTests\DataProviderInterface;

class ParamsToRemoveDataProvider implements DataProviderInterface
{
    public function provides(): array
    {
        return [
            [['test' => 'string'], 'test'],
            [['test' => 1], 'test'],
            [['test' => 3.14], 'test'],
            [['test' => null], 'test'],
            [['test' => true], 'test'],
            [['test' => false], 'test'],
            [['test' => -6.23], 'test'],
        ];
    }
}
