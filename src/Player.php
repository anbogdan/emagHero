<?php

namespace EmagHero;

use Monolog\Logger;

abstract class Player
{
    protected Stats $stats;
    protected Logger $logger;

    public function __construct($stats, Logger $logger)
    {
        $this->logger = $logger;
        $this->stats = $stats;
    }

    protected function getLucky()
    {
        try {
            if (mt_rand(0, 100) < $this->stats->getStat("luck")) {
                return True;
            }
        } catch (\Exception $e) {
            exit(get_class($this).":".$e);
        }
        return False;
    }

    public function getStat($stat)
    {
        try {
            return $this->stats->getStat($stat);
        } catch (\Exception $e) {
            exit(get_class($this).":".$e);
        }
    }

    public function setStat($stat, $value)
    {
        $this->stats->setStat($stat, $value);
    }

    public function getAttack()
    {
        $this->logger->info($this." attacked.");
    }
    public function takeDamage($damage)
    {
        $this->logger->info($this." defended.");
    }
}