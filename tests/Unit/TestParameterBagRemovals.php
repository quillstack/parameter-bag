<?php

declare(strict_types=1);

namespace Quillstack\ParameterBag\Tests\Unit;

use Quillstack\ParameterBag\ParameterBag;
use Quillstack\ParameterBag\Tests\DataProviders\ParamsToRemoveDataProvider;
use Quillstack\UnitTests\Attributes\ProvidesDataFrom;
use Quillstack\UnitTests\Types\AssertArray;
use Quillstack\UnitTests\Types\AssertBoolean;

class TestParameterBagRemovals
{
    public function __construct(private AssertBoolean $assertBoolean, private AssertArray $assertArray)
    {
        //
    }

    #[ProvidesDataFrom(ParamsToRemoveDataProvider::class)]
    public function remove($params, $key)
    {
        $bag = new ParameterBag($params);

        $this->assertBoolean->isTrue($bag->has($key));
        $this->assertBoolean->isTrue($bag->remove($key));
        $this->assertBoolean->isFalse($bag->has($key));
    }

    public function countBeforeAndAfter()
    {
        $bag = new ParameterBag([
            'test1' => 'string',
            'test2' => 'string',
            'test3' => 'string',
        ]);

        $this->assertArray->count(3, $bag->all());
        $bag->remove('test2');
        $this->assertArray->count(2, $bag->all());
    }

    public function paramNotExists()
    {
        $bag = new ParameterBag();

        $this->assertBoolean->isFalse($bag->remove('doesn\'t exist'));
    }
}
