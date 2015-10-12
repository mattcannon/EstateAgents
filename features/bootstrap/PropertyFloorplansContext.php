<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use MattCannon\EstateAgents\Media\Floorplan;
use MattCannon\EstateAgents\Property;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class PropertyFloorplansContext implements Context, SnippetAcceptingContext
{
    use TransformPrice;

    /**
     * Initializes context.
     *
     * Each scenario receives its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }


    /**
     * @Given there is a property with a floorplan located at :arg1 with a caption of :arg2
     */
    public function thereIsAPropertyWithAFloorplanLocatedAtWithACaptionOf($url, $caption)
    {
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'floorplans' => [
                Floorplan::fromUrlAndCaption($url, $caption)
            ]
        ]);
    }

    /**
     * @Then it should return an array with :count floorplan
     * @Then it should return an array with :count floorplans
     */
    public function itShouldReturnAnArrayWithFloorplan($count)
    {
        PHPUnit_Framework_Assert::assertCount($count, $this->property->floorplans());
    }

    /**
     * @Then its first floorplan should have a url of :url with a caption of :caption
     */
    public function itsFirstFloorplanShouldHaveAUrlOfWithACaptionOf($url, $caption)
    {
        $floorplans = $this->property->floorplans();
        PHPUnit_Framework_Assert::assertEquals($url, $floorplans[0]->url());
        PHPUnit_Framework_Assert::assertEquals($caption, $floorplans[0]->caption());
    }

    /**
     * @Given there is a property with :count floorplans
     */
    public function thereIsAPropertyWithFloorplans($count)
    {
        $floorplans = [];
        for ($i = 0; $i < $count; $i++) {
            $floorplans[] = Floorplan::fromUrlAndCaption('http://floorplan.url/test.pdf', 'ground floor');
        }
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'floorplans' => $floorplans
        ]);
    }
}

