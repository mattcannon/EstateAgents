<?php

/**
 * Created by PhpStorm.
 * User: matt
 * Date: 15/09/2015
 * Time: 22:52
 */
trait TransformPrice
{
    /**
     * @Transform :price
     * @Transform :lowPrice
     * @Transform :highPrice
     */
    public function transformStringToPrice($price)
    {
        return MattCannon\EstateAgents\Price::fromString($price);
    }

    /**
     * @Transform :count
     */
    public function transformNumberToInt($number)
    {
        return intval($number);
    }
}