<?php

namespace spec\MattCannon\EstateAgents;

use MattCannon\EstateAgents\Price;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PriceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromString',['£500,000']);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\EstateAgents\Price');
    }
    function it_should_be_able_to_subtract()
    {
        $this->beConstructedThrough('fromString',['£50']);
        $this->subtract(Price::fromString(10))->equalTo(Price::fromString(40))->shouldReturn(true);
    }
    function it_should_be_able_to_add()
    {
        $this->beConstructedThrough('fromString',['£50']);
        $this->add(Price::fromString(10))->equalTo(Price::fromString(60))->shouldReturn(true);
    }
    function it_should_be_able_to_check_if_greater_than_another_instance()
    {
        $this->beConstructedThrough('fromString',['£50']);
        $this->isGreaterThan(Price::fromString('£40'))->shouldReturn(true);
        $this->isGreaterThan(Price::fromString('£50'))->shouldReturn(false);
        $this->isGreaterThan(Price::fromString('£60'))->shouldReturn(false);
    }
    function it_should_be_able_to_check_if_not_greater_than_another_instance()
    {
        $this->beConstructedThrough('fromString',['£50']);
        $this->isNotGreaterThan(Price::fromString('£60'))->shouldReturn(true);
        $this->isNotGreaterThan(Price::fromString('£50'))->shouldReturn(true);
        $this->isNotGreaterThan(Price::fromString('£40'))->shouldReturn(false);
    }
    function it_should_be_able_to_check_if_less_than_another_instance()
    {
        $this->beConstructedThrough('fromString',['£50']);
        $this->isLessThan(Price::fromString('£60'))->shouldReturn(true);
        $this->isLessThan(Price::fromString('£50'))->shouldReturn(false);
        $this->isLessThan(Price::fromString('£40'))->shouldReturn(false);
    }
    function it_should_be_able_to_check_if_not_less_than_another_instance()
    {
        $this->beConstructedThrough('fromString',['£50']);
        $this->isNotLessThan(Price::fromString('£60'))->shouldReturn(false);
        $this->isNotLessThan(Price::fromString('£50'))->shouldReturn(true);
        $this->isNotLessThan(Price::fromString('£40'))->shouldReturn(true);
    }
    
}
