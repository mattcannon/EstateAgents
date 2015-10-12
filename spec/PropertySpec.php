<?php

namespace spec\MattCannon\EstateAgents;

use MattCannon\EstateAgents\Price;
use MattCannon\EstateAgents\Property;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropertySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('withDetails', [['type' => Property::rental]]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\EstateAgents\Property');
    }

    function it_can_check_if_it_is_a_rental_property()
    {
        $this->shouldBeRental();
    }

    function it_can_check_if_it_is_a_sales_property()
    {
        $this->beConstructedThrough('withDetails', [['type' => Property::sales]]);
        $this->shouldBeSales();
    }

    function it_can_return_price()
    {
        $this->price()->shouldReturnAnInstanceOf(Price::class);
    }

    function it_should_return_payment_frequency()
    {
        $this->paymentFrequency();
    }

    function it_should_return_an_array_for_images()
    {
        $this->images()->shouldBeArray();
    }

    function it_should_return_an_array_for_floorplans()
    {
        $this->floorplans()->shouldBeArray();
    }

    function it_should_return_an_array_for_epcs()
    {
        $this->epcs()->shouldBeArray();
    }
    function it_should_return_an_agent_ref(){
        $this->agentRef()->shouldBeString();
    }
    function it_should_have_display_address(){
        $this->displayAddress()->shouldBeString();
    }
    function it_should_return_the_number_of_bedrooms(){
        $this->numberOfBedrooms()->shouldBeString();
    }
    function it_should_return_an_array_of_features()
    {
        $this->features()->shouldBeArray();
    }
    function it_should_return_description()
    {
        $this->description()->shouldBeString();
    }
    function it_should_return_a_property_type()
    {
        $this->propertyType()->shouldBeString();
    }
}
