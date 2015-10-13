<?php

namespace spec\MattCannon\EstateAgents;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomSpec extends ObjectBehavior
{
    function let()
    {
        $title = 'title';
        $measurements = 'size';
        $description = 'description';
        $this->beConstructedThrough('withDetails',[compact('title','measurements','description')]);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\EstateAgents\Room');
    }
    
    function it_has_a_description(){
        $this->description()->shouldBeString();
    }
    function it_has_title(){
        $this->title()->shouldBeString();
    }
    function it_has_measurements()
    {
        $this->measurements()->shouldBeString();
    }
}
