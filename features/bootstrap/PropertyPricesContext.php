<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use MattCannon\EstateAgents\Price;
use MattCannon\EstateAgents\Property;

/**
 * Defines application features from the specific context.
 */
class PropertyPricesContext implements Context, SnippetAcceptingContext
{
    use TransformPrice;
    /** @var  Property */
    protected $property;

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
     * @Given there is a new property
     */
    public function thereIsANewProperty()
    {
        $this->property = Property::withDetails(['type' => Property::rental]);
    }

    /**
     * @Then it's price should be equal to £:price
     */
    public function itSPriceShouldBeEqualToPs(Price $price)
    {
        PHPUnit_Framework_Assert::assertTrue($price->equalTo($this->property->price()));
    }

    /**
     * @Given it has a price of £:price
     */
    public function itHasAPriceOfPs($price)
    {
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'price' => $price
        ]);
    }

    /**
     * @Given there is a new sales property
     */
    public function thereIsANewSalesProperty()
    {
        $this->property = Property::withDetails([
            'type' => Property::sales
        ]);
    }

    /**
     * @Then it's payment frequency should be empty
     */
    public function itSPaymentFrequencyShouldBeEmpty()
    {
        PHPUnit_Framework_Assert::assertEquals(Property::singlePurchase, $this->property->paymentFrequency());
    }

    /**
     * @Given there is a new rental property
     */
    public function thereIsANewRentalProperty()
    {
        $this->property = Property::withDetails([
            'type' => Property::rental
        ]);
    }

    /**
     * @Given it's payment frequency is set to weekly
     */
    public function itSPaymentFrequencyIsSetToWeekly()
    {
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'frequency' => Property::weekly
        ]);
    }

    /**
     * @Then it's payment frequency should be equal to :frequency
     */
    public function itSPaymentFrequencyShouldBeEqualTo($frequency)
    {
        PHPUnit_Framework_Assert::assertEquals($frequency, $this->property->paymentFrequency());
    }

    /**
     * @Given it's payment frequency is set to monthly
     */
    public function itSPaymentFrequencyIsSetToMonthly()
    {
        $this->property = Property::withDetails([
            'type' => Property::rental,
            'frequency' => Property::monthly
        ]);
    }

}
