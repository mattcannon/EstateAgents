<?php

namespace MattCannon\EstateAgents;

use MattCannon\EstateAgents\Media\Epc;
use MattCannon\EstateAgents\Media\Floorplan;
use MattCannon\EstateAgents\Media\Image;

/**
 * Class Property
 * @package MattCannon\EstateAgents
 */
class Property
{
    /**
     * Type constant for rental property
     */
    const rental = 'rent';
    /**
     * Type constant for sales property
     */
    const sales = 'sales';
    /**
     * frequency constant for monthly payment
     */
    const monthly = 'pcm';
    /**
     * frequency constant for weekly payment
     */
    const weekly = 'pw';
    /**
     * frequency constant for one of payment
     */
    const singlePurchase = '';
    /**
     * @var array
     */
    public $attributes = [];
    public $original;
    /**
     * @var array
     */
    protected $images = [];
    /**
     * @var array
     */
    protected $floorplans = [];
    /**
     * @var array
     */
    protected $epcs = [];
    /**
     * @var \MattCannon\EstateAgents\Price
     */
    protected $price;
    /**
     * @var string
     */
    protected $frequency = Property::singlePurchase;
    protected $agentRef;

    /**
     * @param array $details
     * @return Property
     */
    public static function withDetails(array $details)
    {
        $property = new Static();
        $property->attributes = $details;
        $property->mergeWithInitialValues($details);
        $property->original = isset($details['original']) ? $details['original'] : [];
        return $property;
    }

    /**
     * @return bool
     */
    public function isRental()
    {
        return array_key_exists('type', $this->attributes) && $this->attributes['type'] == self::rental;
    }

    /**
     * @return bool
     */
    public function isSales()
    {
        return array_key_exists('type', $this->attributes) && $this->attributes['type'] == self::sales;
    }

    /**
     * @return mixed
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function paymentFrequency()
    {
        return $this->frequency;
    }

    /**
     * @return array
     */
    public function images()
    {
        return $this->images;
    }

    /**
     * @return array
     */
    public function floorplans()
    {
        return $this->floorplans;
    }

    /**
     * @return array
     */
    public function epcs()
    {
        return $this->epcs;
    }

    /**
     * @return array
     */
    private function getDefaults()
    {
        return [
            'agentRef' => [
                'value' => '',
                'type' => 'string'
            ],
            'images' => [
                'value' => [],
                'type' => Image::class
            ],
            'floorplans' => [
                'value' => [],
                'type' => Floorplan::class
            ],
            'epcs' => [
                'value' => [],
                'type' => Epc::class],
            'price' => [
                'value' => Price::fromString('0'),
                'type' => Price::class
            ],
            'frequency' => [
                'value' => Property::singlePurchase,
                'type' => 'string'
            ],
            'displayAddress' => [
                'value' => '',
                'type' => 'string'
            ],
            'bedrooms' => [
                'value' => '',
                'type' => 'string'
            ],
            'features' => [
                'value' => [],
                'type' => 'string'
            ],
            'description' => [
                'value' => '',
                'type' => 'string'
            ],
            'propertyType' => [
                'value' => '',
                'type' => 'string'
            ],
            'rooms' => [
                'value' => [],
                'type' => Room::class
            ],
            'town' => [
                'value' => '',
                'type' => 'string'
            ],
            'postcode' => [
                'value' => '',
                'type' => 'string'
            ],
            'location' => [
                'value' => Location::withLatitudeAndLongitude(0, 0),
                'type' => Location::class
            ],
            'virtual_tour_url' => [
                'value' => '',
                'type' => 'string'
            ]
        ];
    }

    /**
     * @param array $initialValues
     */
    private function mergeWithInitialValues(array $initialValues)
    {
        foreach ($this->getDefaults() as $key => $defaults) {
            $value = array_key_exists($key, $initialValues) ? $initialValues[$key] : null;
            $this->updateValue($key, $value, $defaults);
        }
    }

    /**
     * @param $key
     * @param $value
     * @param $defaults
     */
    private function updateValue($key, $value, $defaults)
    {
        $resolvedValue = (!is_null($value)) ? $this->returnValueIfValid($defaults['type'], $value) : $defaults['value'];
        $this->$key = $resolvedValue;
    }

    /**
     * @param $value
     * @param $type
     * @return array
     * @throws \Exception
     */
    private function returnValueIfValid($type, $value)
    {
        (is_array($value)) ? $this->validateArrayElementsType($type, $value) : $this->validateType($type, $value);
        return $value;
    }

    /**
     * @param $array
     * @param $type
     * @throws \Exception
     */
    private function validateArrayElementsType($type, $array)
    {
        foreach ($array as $object) {
            $this->validateType($type, $object);
        }
    }

    /**
     * @param $type
     * @param $object
     * @throws \Exception
     */
    private function validateType($type, $object)
    {
        if ($type != 'string') {
            if (!is_a($object, $type)) {
                throw new \Exception('Type doesn\'t match constraints');
            }
        }
    }

    public function agentRef()
    {
        return $this->agentRef;
    }

    public function displayAddress()
    {
        return $this->displayAddress;
    }

    public function features()
    {
        return $this->features;
    }

    public function description()
    {
        return $this->description;
    }

    public function propertyType()
    {
        return $this->propertyType;
    }

    public function numberOfBedrooms()
    {
        return $this->bedrooms;
    }

    public function rooms()
    {
        return $this->rooms;
    }

    public function town()
    {
        return $this->town;
    }

    public function postcode()
    {
        return $this->postcode;
    }

    public function location()
    {
        return $this->location;
    }
}
