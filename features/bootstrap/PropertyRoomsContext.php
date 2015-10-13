<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use MattCannon\EstateAgents\PropertiesRepository;
use MattCannon\EstateAgents\Property;
use MattCannon\EstateAgents\Room;

class PropertyRoomsContext implements Context, SnippetAcceptingContext
{

    /**
     * @var PropertiesRepository
     */
    private $repository;

    public function __construct()
    {

        $this->propertiesRepository = new PropertiesRepository;
    }

    /**
     * @Given there is a property with a room and agent ref :agentRef
     */
    public function thereIsAPropertyWithARoomAndAgentRef($agentRef)
    {
        $title = 'title';
        $measurements = 'size';
        $description = 'description';
        $this->property = Property::withDetails(['rooms' => [Room::withDetails(compact('title', 'measurements', 'description'))]]);
    }


    /**
     * @Then the room should have a description
     */
    public function theRoomShouldHaveADescription()
    {
        $rooms = $this->property->rooms();
        PHPUnit_Framework_Assert::assertTrue(is_string($rooms[0]->description()));
    }

    /**
     * @Then the room should have a title
     */
    public function theRoomShouldHaveATitle()
    {
        $rooms = $this->property->rooms();
        PHPUnit_Framework_Assert::assertTrue(is_string($rooms[0]->title()));
    }

    /**
     * @Then the room should have measurements
     */
    public function theRoomShouldHaveMeasurements()
    {
        $rooms = $this->property->rooms();
        PHPUnit_Framework_Assert::assertTrue(is_string($rooms[0]->measurements()));
    }

}