<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Quillstack\ParameterBag\ParameterBag;

class ParameterBagRemovalsTest extends TestCase
{
    /**
     * @dataProvider paramsProvider
     */
    public function testRemove($params, $key)
    {
        $bag = new ParameterBag($params);

        $this->assertTrue($bag->has($key));
        $this->assertTrue($bag->remove($key));
        $this->assertFalse($bag->has($key));
    }

    public function testCountBeforeAfterRemoval()
    {
        $bag = new ParameterBag([
            'test1' => 'string',
            'test2' => 'string',
            'test3' => 'string',
        ]);

        $this->assertCount(3, $bag->all());
        $bag->remove('test2');
        $this->assertCount(2, $bag->all());
    }

    public function testRemovalDoesntExist()
    {
        $bag = new ParameterBag();

        $this->assertFalse($bag->remove('doesn\'t exist'));
    }

    public function paramsProvider()
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
