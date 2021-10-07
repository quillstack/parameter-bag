<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Quillstack\ParameterBag\ParameterBag;

class ParameterBagTest extends TestCase
{
    /**
     * @dataProvider paramsProvider
     */
    public function testParams($params, $key, $value)
    {
        $bag = new ParameterBag($params);

        $this->assertTrue($bag->has($key));
        $this->assertEquals($value, $bag->get($key));
    }

    public function testOverwritingParams()
    {
        $bag = new ParameterBag(['test' => 'string']);

        $bag->set('test', 2);
        $this->assertEquals(2, $bag->get('test'));
    }

    public function testSettingParams()
    {
        $bag = new ParameterBag();

        $bag->set('test', 3.14);
        $this->assertEquals(3.14, $bag->get('test'));
    }

    public function testChainSettingParams()
    {
        $bag = new ParameterBag();

        $bag->set('test', 3.14)->set('int', 5);
        $this->assertEquals(3.14, $bag->get('test'));
        $this->assertEquals(5, $bag->get('int'));
    }

    public function paramsProvider()
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
