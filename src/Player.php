<?php

namespace EmagHero;

use Monolog\Logger;

class Player
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
        try {
            return $this->stats->getStat("strength");
        } catch (\Exception $e) {
            exit(get_class($this).":".$e);
        }
    }
    public function takeDamage($damage)
    {
        $this->logger->info($this." defended.");
        try {
            if($damage - $this->getStat("defence") < 0) return 0;
            $this->setStat("health",
                $this->getStat("health") - $damage + $this->getStat("defence"));
        } catch (\Exception $e) {
            exit(get_class($this).":".$e);
        }
        return $damage - $this->getStat("defence");
    }

    public function applySkill(Skill $skill, $stat)
    {
        return $skill->try($stat);
    }

    public function __toString()
    {
        return "Player";
    }
}