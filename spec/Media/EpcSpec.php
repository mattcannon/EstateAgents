<?php

namespace spec\MattCannon\EstateAgents\Media;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EpcSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromUrlAndCaption', ['http://url', 'caption']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\EstateAgents\Media\Epc');
    }
    
    
}
