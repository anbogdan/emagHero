<?php

namespace EmagHero;

class Monster extends Player
{
    public function __toString()
    {
        return "Monster";
    }

    public function takeDamage($damage)
    {
        if($this->getLucky()){
            $this->logger->info($this." got lucky and received no damage.");
            return 0;
        }
        return parent::takeDamage($damage);
    }
}