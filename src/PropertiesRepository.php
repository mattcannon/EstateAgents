<?php

namespace MattCannon\EstateAgents;
use MattCannon\EstateAgents\Interfaces\PropertiesRepository as PropertiesRepositoryInterface;
use MattCannon\EstateAgents\Interfaces\PropertyCreator;

/**
 * Class PropertiesRepository
 * @package MattCannon\EstateAgents
 */
class PropertiesRepository implements PropertiesRepositoryInterface, PropertyCreator
{
    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @param array $properties
     */
    public function addProperties(array $properties)
    {
        foreach ($properties as $property) {
            $this->properties[] = $property;
        }
    }

    /**
     * @param Price $lowPrice
     * @param Price $highPrice
     * @return array
     */
    public function listRentalPropertiesBetween(Price $lowPrice, Price $highPrice)
    {
        return array_filter($this->listRentalProperties(), function (&$element) use ($lowPrice, $highPrice) {
            return $element->price()->isNotLessThan($lowPrice) && $element->price()->isNotGreaterThan($highPrice);
        });
    }

    /**
     * @return array
     */
    public function listRentalProperties()
    {
        return array_filter($this->properties, function (&$element) {
            return $element->isRental();
        });
    }

    /**
     * @param Price $lowPrice
     * @param Price $highPrice
     * @return array
     */
    public function listSalesPropertiesBetween(Price $lowPrice, Price $highPrice)
    {
        return array_filter($this->listSalesProperties(), function (&$element) use ($lowPrice, $highPrice) {
            return $element->price()->isNotLessThan($lowPrice) && $element->price()->isNotGreaterThan($highPrice);
        });
    }

    /**
     * @return array
     */
    public function listSalesProperties()
    {
        return array_filter($this->properties, function (&$element) {
            return $element->isSales();
        });
    }

    /**
     * @param $agentRef
     * @return Property | null
     */
    public function find($agentRef)
    {
        $properties = array_filter($this->properties, function (&$element) use ($agentRef){
            return $element->agentRef() == $agentRef;
        });
        
        return isset($properties[0]) ? $properties[0] : null; 
    }
}
