<?php

namespace EmagHero;

abstract class Player
{
    private Stats $stats;

    public function __construct($stats)
    {
        $this->stats = $stats;
    }

    public function getStat($stat)
    {
        try {
            return $this->stats->getStat($stat);
        } catch (\Exception $e) {
            exit(get_class().":".$e);
        }
    }
}