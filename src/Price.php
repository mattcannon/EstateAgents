<?php

namespace MattCannon\EstateAgents;

use NumberFormatter;

class Price
{

    protected $amount;

    public function subtract(Price $amount)
    {
        $value = ($this->amount - $amount->amount) / 100.00;
        return Self::fromString($value);
    }

    public static function fromString($string)
    {
        $price = new Price();
        $result = preg_replace("/£?([0-9]+)[\\,?]{0,}(\\.[0-9]{2})?/usm", "$1$2", $string);
        $price->amount = intval($result * 100);
        return $price;
    }

    public function equalTo(Price $amount)
    {
        return $amount->amount == $this->amount;
    }

    public function add(Price $amount)
    {
        $value = ($this->amount + $amount->amount) / 100.00;
        return Self::fromString($value);
    }

    public function isNotGreaterThan(Price $price)
    {
        return !$this->isGreaterThan($price);
    }

    public function isGreaterThan(Price $price)
    {
        return $this->amount > $price->amount;
    }

    public function isNotLessThan(Price $price)
    {
        return !$this->isLessThan($price);
    }

    public function isLessThan(Price $price)
    {
        return $this->amount < $price->amount;
    }
    public function __toString()
    {
        return number_format($this->amount,0);
    }
}
