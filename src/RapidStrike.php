<?php

namespace EmagHero;

class RapidStrike implements Skill
{
    private int $chance;
    private MyLogger $logger;

    public function __construct($chance, $logger)
    {
        $this->chance = $chance;
        $this->logger = $logger;
    }

    public function try($damage)
    {
        if(mt_rand(0,100) < $this->chance) {
            $this->logger->info($this." was used.");
            return $damage * 2;
        }
        return $damage;
    }

    public function __toString()
    {
        return "Rapid Strike";
    }
}