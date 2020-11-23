<?php

namespace EmagHero;

class Monster extends Player
{

    public function getAttack()
    {
        parent::getAttack();
        try {
            return $this->stats->getStat("strength");
        } catch (\Exception $e) {
            exit(get_class($this).":".$e);
        }
    }

    public function takeDamage($damage)
    {
        if($this->getLucky()){
            $this->logger->info($this." got lucky and received no damage.");
            return 0;
        }
        parent::takeDamage($damage);
        try {
            $attackDamage = $damage;
            if($attackDamage - $this->getStat("defence") < 0) return 0;
            $this->setStat("health",
                $this->getStat("health") - $attackDamage + $this->getStat("defence"));
        } catch (\Exception $e) {
            exit(get_class($this).":".$e);
        }
        return $attackDamage - $this->getStat("defence");
    }

    public function __toString()
    {
        return "Monster";
    }
}