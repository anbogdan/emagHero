<?php

abstract class Player
{
    private Stats $stats;

    public function __construct($stats)
    {
        $this->stats = $stats;
    }

    public function getPower() {
        if (isset($this->power)) {
            return $this->power;
        }
        throw new Exception(get_class()." has no power set.");
    }
}