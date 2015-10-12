<?php

namespace spec\MattCannon\EstateAgents\Media;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FloorplanSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromUrlAndCaption', ['http://imageurl.com/image.jpg', 'Test Image']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\EstateAgents\Media\Floorplan');
    }
}
