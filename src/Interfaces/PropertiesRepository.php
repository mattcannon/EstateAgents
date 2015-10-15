<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/10/2015
 * Time: 10:09
 */
namespace MattCannon\EstateAgents\Interfaces;
use MattCannon\EstateAgents\Price;
use MattCannon\EstateAgents\Property;


/**
 * Class PropertiesRepository
 * @package MattCannon\EstateAgents
 */
interface PropertiesRepository
{
    
    /**
     * @param Price $lowPrice
     * @param Price $highPrice
     * @return array
     */
    public function listRentalPropertiesBetween(Price $lowPrice, Price $highPrice);

    /**
     * @return array
     */
    public function listRentalProperties();

    /**
     * @param Price $lowPrice
     * @param Price $highPrice
     * @return array
     */
    public function listSalesPropertiesBetween(Price $lowPrice, Price $highPrice);

    /**
     * @return array
     */
    public function listSalesProperties();

    /**
     * @param $agentRef
     * @return Property | null
     */
    public function find($agentRef);

    /**
     * @param $location
     * @param $lowPrice
     * @param $highPrice
     * @return array
     */
    public function listSalesPropertiesForLocationPricedBetween($location, Price $lowPrice, Price $highPrice);

    /**
     * @param $location
     * @param $lowPrice
     * @param $highPrice
     * @return array
     */
    public function listRentalPropertiesForLocationPricedBetween($location, Price $lowPrice, Price $highPrice);
}