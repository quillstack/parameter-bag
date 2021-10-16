<?php

declare(strict_types=1);

namespace Quillstack\ParameterBag\Tests\Unit;

use Quillstack\ParameterBag\ParameterBag;
use Quillstack\UnitTests\AssertEqual;

class TestParameterBagConstruct
{
    public function __construct(private AssertEqual $assertEqual)
    {
        //
    }

    public function success()
    {
        $params = [
            'test' => 1,
        ];

        $this->assertEqual->equal($params, (new ParameterBag($params))->all());
    }
}
