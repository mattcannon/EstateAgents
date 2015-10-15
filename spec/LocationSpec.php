<?php

namespace spec\MattCannon\EstateAgents;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('withLatitudeAndLongitude',['52.8','-0.8']);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\EstateAgents\Location');
    }
}
