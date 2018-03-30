<?php

namespace App\Classes;

class Splitter
{
    /**
     * Properties
     */
    private $total; #Bill total
    private $tipMultiplier; #Tip multiplier that will be applied to the split bill

    /**
     * Magic method
     */
    public function __construct($total, $tip)
    {
        $this->total = $total;
        $this->tipMultiplier = ($tip / 100) + 1;
    }

    public function splitBill($numberOfWays)
    {
        return ($this->total / $numberOfWays) * $this->tipMultiplier;
    }

    # Rounds up to the nearest dollar if toDollarAmount is true
    public function roundAmount($amount, $toDollarAmount = false)
    {
        if ($toDollarAmount) {
            return ceil($amount);
        } else {
            return round($amount, 2);
        }
    }

    public function displayAsCurrency($amount)
    {
        return money_format('$%i', $amount);
    }
}