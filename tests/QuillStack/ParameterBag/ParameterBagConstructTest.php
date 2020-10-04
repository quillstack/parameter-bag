<?php

declare(strict_types=1);

namespace QuillStack\ParameterBag;

use PHPUnit\Framework\TestCase;

final class ParameterBagConstructTest extends TestCase
{
    public function testArray()
    {
        $params = [
            'test' => 1,
        ];

        $this->assertEquals($params, (new ParameterBag($params))->all());
    }
}
