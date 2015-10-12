<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/10/2015
 * Time: 11:21
 */
namespace MattCannon\EstateAgents\Interfaces;


/**
 * Class PropertiesRepository
 * @package MattCannon\EstateAgents
 */
interface PropertyCreator
{
    /**
     * @param array $properties
     */
    public function addProperties(array $properties);
}