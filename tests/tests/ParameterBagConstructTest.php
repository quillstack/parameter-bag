<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Quillstack\ParameterBag\ParameterBag;

class ParameterBagConstructTest extends TestCase
{
    public function testArray()
    {
        $params = [
            'test' => 1,
        ];

        $this->assertEquals($params, (new ParameterBag($params))->all());
    }
}
