<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use MattCannon\EstateAgents\Media\Image;
use MattCannon\EstateAgents\Property;

/**
 * Defines application features from the specific context.
 */
class PropertyImagesContext implements Context, SnippetAcceptingContext
{
    /** @var  Property */
    protected $property;

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
     * @Given there is a property with an image located at :url with a caption of :caption
     */
    public function thereIsAPropertyWithAnImageLocatedAtWithACaptionOf($url, $caption)
    {
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'images' => [
                Image::fromUrlAndCaption($url, $caption)
            ]
        ]);
    }

    /**
     * @Then it should return an array with :count image
     * @Then it should return an array with :count images
     */
    public function itShouldReturnAnArrayWithImage($count)
    {
        $images = $this->property->images();
        PHPUnit_Framework_Assert::assertCount($count, $images);
    }

    /**
     * @Then its first image should have a url of :url with a caption of :caption
     */
    public function itsFirstImageShouldHaveAUrlOfWithACaptionOf($url, $caption)
    {
        $images = $this->property->images();
        PHPUnit_Framework_Assert::assertEquals($url, $images[0]->url());
        PHPUnit_Framework_Assert::assertEquals($caption, $images[0]->caption());
    }

    /**
     * @Given there is a property with :count images
     */
    public function thereIsAPropertyWithImages($count)
    {
        $images = [];
        for ($i = 0; $i < $count; $i++) {
            $images[] = Image::fromUrlAndCaption('http://imageurl.com/test.jpg', 'test image');
        }
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'images' => $images
        ]);
    }
    

}
