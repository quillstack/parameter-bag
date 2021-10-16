<?php

declare(strict_types=1);

namespace Quillstack\ParameterBag\Tests\Unit;

use Quillstack\ParameterBag\ParameterBag;
use Quillstack\ParameterBag\Tests\DataProviders\ParamsDataProvider;
use Quillstack\UnitTests\AssertEqual;
use Quillstack\UnitTests\Attributes\ProvidesDataFrom;
use Quillstack\UnitTests\Types\AssertBoolean;

class TestParameterBag
{
    public function __construct(private AssertBoolean $assertBoolean, private AssertEqual $assertEqual)
    {
        //
    }

    #[ProvidesDataFrom(ParamsDataProvider::class)]
    public function params($params, $key, $value)
    {
        $bag = new ParameterBag($params);

        $this->assertBoolean->isTrue($bag->has($key));
        $this->assertEqual->equal($value, $bag->get($key));
    }

    public function overwritingParams()
    {
        $bag = new ParameterBag(['test' => 'string']);

        $this->assertBoolean->isTrue($bag->has('test'));
        $bag->set('test', 2);
        $this->assertBoolean->isTrue($bag->has('test'));
    }

    public function settingParams()
    {
        $bag = new ParameterBag();

        $bag->set('test', 3.14);
        $this->assertEqual->equal(3.14, $bag->get('test'));
    }

    public function chainSettingParams()
    {
        $bag = new ParameterBag();

        $bag->set('test', 3.14)->set('int', 5);
        $this->assertEqual->equal(3.14, $bag->get('test'));
        $this->assertEqual->equal(5, $bag->get('int'));
    }
}
