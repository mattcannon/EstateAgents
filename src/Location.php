<?php

namespace MattCannon\EstateAgents;

class Location
{

    public $longitude;
    public $latitude;

    public static function withLatitudeAndLongitude($latitude, $longitude)
    {
        $location = new Location();

        $location->latitude = $latitude;
        $location->longitude = $longitude;

        return $location;
    }
}
