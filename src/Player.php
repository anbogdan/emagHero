<?php

namespace EmagHero;

abstract class Player
{
    private Stats $stats;

    public function __construct($stats)
    {
        $this->stats = $stats;
    }
}