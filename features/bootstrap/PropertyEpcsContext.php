<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use MattCannon\EstateAgents\Media\Epc;
use MattCannon\EstateAgents\Property;

/**
 * Defines application features from the specific context.
 */
class PropertyEpcsContext implements Context, SnippetAcceptingContext
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
    }
    /**
     * @Given there is a property with a epc located at :url with a caption of :caption
     */
    public function thereIsAPropertyWithAEpcLocatedAtWithACaptionOf($url, $caption)
    {
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'epcs' => [Epc::fromUrlAndCaption($url, $caption)]
        ]);
    }

    /**
     * @Then it should return an array with :count epc
     * @Then it should return an array with :count epcs
     */
    public function itShouldReturnAnArrayWithEpc($count)
    {
        $epcs = $this->property->epcs();
        PHPUnit_Framework_Assert::assertCount($count, $epcs);
    }

    /**
     * @Then its first epc should have a url of :url with a caption of :caption
     */
    public function itsFirstEpcShouldHaveAUrlOfWithACaptionOf($url, $caption)
    {
        $epcs = $this->property->epcs();
        PHPUnit_Framework_Assert::assertEquals($url, $epcs[0]->url());
        PHPUnit_Framework_Assert::assertEquals($caption, $epcs[0]->caption());
    }

    /**
     * @Given there is a property with :count epcs
     */
    public function thereIsAPropertyWithEpcs($count)
    {
        $epcs = [];
        for ($i = 0; $i < $count; $i++) {
            $epcs[] = Epc::fromUrlAndCaption('http://url.com/image.jpg', 'caption');
        }
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'epcs' => $epcs
        ]);
    }

}
