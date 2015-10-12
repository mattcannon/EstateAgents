<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use MattCannon\EstateAgents\Price;
use MattCannon\EstateAgents\PropertiesRepository;
use MattCannon\EstateAgents\Property;

/**
 * Defines application features from the specific context.
 */
class PropertiesContext implements Context, SnippetAcceptingContext
{
    use TransformPrice;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->propertiesRepository = new PropertiesRepository;
    }

   

    /**
     * @Given there are :count rental properties
     * @Given there is :count rental property
     */
    public function thereAreRentalProperties($count)
    {
        $properties = [];
        for ($i = 0; $i < $count; $i++) {
            $properties[] = Property::withDetails(['type' => Property::rental]);
        }
        $this->propertiesRepository->addProperties($properties);

    }

    /**
     * @When I list rental properties
     */
    public function iListRentalProperties()
    {
        $this->properties = $this->propertiesRepository->listRentalProperties();
    }


    /**
     * @Then I should only see :count properties
     */
    public function iShouldOnlySeeProperties($count)
    {
        PHPUnit_Framework_Assert::assertEquals($count, sizeof($this->properties));
    }


    /**
     * @Then they should all be properties for rent
     */
    public function theyShouldAllBePropertiesForRent()
    {
        /** @var Property $property */
        foreach ($this->properties as $property) {
            PHPUnit_Framework_Assert::assertEquals(true, $property->isRental());
        }
    }

    /**
     * @Given there are :count sale properties
     * @Given there is :count sale property
     */
    public function thereAreSaleProperties($count)
    {
        $properties = [];
        for ($i = 0; $i < $count; $i++) {
            $properties[] = Property::withDetails(['type' => Property::sales]);
        }
        $this->propertiesRepository->addProperties($properties);
    }

    /**
     * @When I list sale properties
     */
    public function iListSaleProperties()
    {
        $this->properties = $this->propertiesRepository->listSalesProperties();
    }

    /**
     * @Then they should all be properties for sale
     */
    public function theyShouldAllBePropertiesForSale()
    {
        /** @var Property $property */
        foreach ($this->properties as $property) {
            PHPUnit_Framework_Assert::assertEquals(true, $property->isSales());
        }
    }

    /**
     * @Given there are :total rental properties with :count priced under £:price
     */
    public function thereAreRentalPropertiesWithPricedUnderPs($total, $count, Price $price)
    {
        $properties = [];
        for ($i = 0; $i < $count; $i++) {
            $properties[] = Property::withDetails([
                'type' => Property::rental,
                'price' => $price->subtract(Price::fromString(10))
            ]);
        }
        for ($i = 0; $i < ($total - $count); $i++) {
            $properties[] = Property::withDetails([
                'type' => Property::rental,
                'price' => $price->add(Price::fromString(10))
            ]);
        }
        $this->propertiesRepository->addProperties($properties);
    }

    /**
     * @When I list rental properties between £:lowPrice and £:highPrice
     */
    public function iListRentalPropertiesBetweenPsAndPs($lowPrice, $highPrice)
    {
        $this->properties = $this->propertiesRepository->listRentalPropertiesBetween($lowPrice, $highPrice);
    }

    /**
     * @Then I should only see properties between £:lowPrice and £:highPrice
     */
    public function iShouldOnlySeePropertiesBetweenPsAndPs(Price $lowPrice, Price $highPrice)
    {
        foreach ($this->properties as $property) {
            PHPUnit_Framework_Assert::assertTrue($property->price()->isNotLessThan($lowPrice));
            PHPUnit_Framework_Assert::assertFalse($property->price()->isLessThan($lowPrice));
            PHPUnit_Framework_Assert::assertTrue($property->price()->isNotGreaterThan($highPrice));
            PHPUnit_Framework_Assert::assertFalse($property->price()->isGreaterThan($highPrice));
        }
    }


    /**
     * @Then I should see :count properties
     */
    public function iShouldSeeProperties($count)
    {
        PHPUnit_Framework_Assert::assertEquals($count, sizeof($this->properties));
    }

    /**
     * @Given there are :total sale properties with :count priced under £:price
     */
    public function thereAreSalePropertiesWithPricedUnderPs($total, $count, Price $price)
    {
        $properties = [];
        for ($i = 0; $i < $count; $i++) {
            $properties[] = Property::withDetails([
                'type' => Property::sales,
                'price' => $price->subtract(Price::fromString(10))
            ]);
        }
        for ($i = 0; $i < ($total - $count); $i++) {
            $properties[] = Property::withDetails([
                'type' => Property::sales,
                'price' => $price->add(Price::fromString(10))
            ]);
        }
        $this->propertiesRepository->addProperties($properties);
    }

    /**
     * @When I list sale properties between £:lowPrice and £:highPrice
     */
    public function iListSalePropertiesBetweenPsAndPs(Price $lowPrice, Price $highPrice)
    {
        $this->properties = $this->propertiesRepository->listSalesPropertiesBetween($lowPrice, $highPrice);
    }
    /**
     * @Given there is a property with agent ref :agentRef
     */
    public function thereIsAPropertyWithAgentRef($agentRef)
    {
        $property = Property::withDetails(['agentRef'=>$agentRef]);
        $this->propertiesRepository->addProperties([$property]);
    }

    /**
     * @When I find a property with agent ref :agentRef
     */
    public function iFindAPropertyWithAgentRef($agentRef)
    {
        $this->property = $this->propertiesRepository->find($agentRef);
    }

    /**
     * @Then I should see a property with agent ref :agentRef
     */
    public function iShouldSeeAPropertyWithAgentRef($agentRef)
    {
        PHPUnit_Framework_Assert::assertEquals($agentRef,$this->property->agentRef());
    }

  


}
