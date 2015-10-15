<?php
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use MattCannon\EstateAgents\Location;
use MattCannon\EstateAgents\PropertiesRepository;
use MattCannon\EstateAgents\Property;

class PropertyDetailsContext implements Context, SnippetAcceptingContext
{

    use TransformPrice;

    /**
     * @Given there is a detailed property with agent ref :agentRef
     */
    public function thereIsADetailedPropertyWithAgentRef($agentRef)
    {
        $property = Property::withDetails(['agentRef' => $agentRef,
            'features' => ['feature 1', 'feature 2']]);
        $this->propertiesRepository->addProperties([$property]);
    }

    /**
     * @When I find a detailed property with agent ref :agentRef
     */
    public function iFindADetailedPropertyWithAgentRef($agentRef)
    {
        $this->property = $this->propertiesRepository->find($agentRef);
    }

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
     * @Then it should have a display address
     */
    public function itShouldHaveADisplayAddress()
    {
        PHPUnit_Framework_Assert::assertTrue(is_string($this->property->displayAddress()));
    }

    /**
     * @Then it should have an array of features
     */
    public function itShouldHaveAnArrayOfFeatures()
    {
        PHPUnit_Framework_Assert::assertTrue(is_array($this->property->features()));
    }

    /**
     * @Then it should have a description
     */
    public function itShouldHaveADescription()
    {
        PHPUnit_Framework_Assert::assertTrue(is_string($this->property->description()));
    }

    /**
     * @Then it should return the number of bedrooms
     */
    public function itShouldReturnTheNumberOfBedrooms()
    {
        PHPUnit_Framework_Assert::assertTrue(is_string($this->property->numberOfBedrooms()));
    }

    /**
     * @Then it should return the property type
     */
    public function itShouldReturnThePropertyType()
    {
        PHPUnit_Framework_Assert::assertTrue(is_string($this->property->propertyType()));
    }

    /**
     * @Given there is a property with agent ref :agentRef which has a latitude of :lat and a longitude of :long
     */
    public function thereIsAPropertyWithAgentRefWhichHasALatitudeOfAndALongitudeOf($agentRef, $lat, $long)
    {
        $this->property = Property::withDetails([
            'location' => Location::withLatitudeAndLongitude($lat, $long),
            'agentRef' => $agentRef
        ]);
    }

    /**
     * @Then it should have a location property
     */
    public function itShouldHaveALocationProperty()
    {
        PHPUnit_Framework_Assert::assertTrue(is_a(Location::class, $this->property->location()));
    }

}