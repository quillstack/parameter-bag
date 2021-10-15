<?php

declare(strict_types=1);

namespace Quillstack\ParameterBag\Tests\DataProviders;

use Quillstack\UnitTests\DataProviderInterface;

class ParamsDataProvider implements DataProviderInterface
{
    public function provides(): array
    {
        return [
            [['test' => 'string'], 'test', 'string'],
            [['test' => 1], 'test', 1],
            [['test' => 3.14], 'test', 3.14],
            [['test' => null], 'test', null],
            [['test' => true], 'test', true],
            [['test' => false], 'test', false],
            [['test' => -6.23], 'test', -6.23],
        ];
    }
}
