<?php

namespace MattCannon\EstateAgents;

class Room
{

    public static function withDetails($details)
    {
        $room = new Room();
        $required = ['title', 'description', 'measurements'];
        foreach ($required as $key) {
            if (!array_key_exists($key,$details)) {
                throw new \Exception('You must pass in a ' . $key . ' when creating a room.');
            }
            $room->{$key} = $details[$key];
        }


        return $room;
    }

    public function description()
    {
        return $this->description;
    }

    public function title()
    {
        return $this->title;
    }

    public function measurements()
    {
        return $this->measurements;
    }

}