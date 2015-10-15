<?php

namespace spec\MattCannon\EstateAgents;

use MattCannon\EstateAgents\Price;
use MattCannon\EstateAgents\Property;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropertiesRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\EstateAgents\PropertiesRepository');
    }
    function it_can_add_properties(Property $aProperty)
    {
        $this->addProperties([$aProperty]);
    }
    function it_can_list_rental_properties()
    {
        $this->listRentalProperties();
    }
    function it_can_list_rental_properties_between_prices()
    {
        $this->listRentalPropertiesBetween(Price::fromString(500),Price::fromString(1000));
    }
    function it_can_list_sales_properties()
    {
        $this->listSalesProperties();
    }
    function it_can_list_sales_properties_between_prices()
    {
        $this->listSalesPropertiesBetween(Price::fromString(500),Price::fromString(1000));
    }
    function it_can_find_a_property_by_its_agent_ref()
    {
        $this->find('123456');
    }
    function it_can_list_sales_properties_between_prices_for_a_location()
    {
        $this->listSalesPropertiesForLocationPricedBetween('Buckingham',Price::fromString(500),Price::fromString(1000));
    }
    function it_can_list_rental_properties_between_prices_for_a_location()
    {
        $this->listRentalPropertiesForLocationPricedBetween('Buckingham',Price::fromString(500),Price::fromString(1000));
    }
}
