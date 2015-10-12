<?php

namespace spec\MattCannon\EstateAgents\Media;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImageSpec extends ObjectBehavior
{
    function let(){
        $this->beConstructedThrough('fromUrlAndCaption',['http://imageurl.com/image.jpg','Test Image']);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\EstateAgents\Media\Image');
    }
    function it_should_allow_querying_of_url()
    {
        $this->url();
    }
    function it_should_allow_querying_of_caption()
    {
        $this->caption();
    }
}
