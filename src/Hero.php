<?php

namespace EmagHero;

use Monolog\Logger;

class Hero extends Player
{
    /**
     * @var RapidStrike
     */
    private RapidStrike $rapidStrike;
    /**
     * @var MagicShield
     */
    private MagicShield $magicShield;

    public function __construct($stats, Logger $logger)
    {
        parent::__construct($stats, $logger);
        $this->rapidStrike = new RapidStrike(10, $this->logger);
        $this->magicShield = new MagicShield(20, $this->logger);
    }

    public function getAttack()
    {
        $this->logger->info($this." attacked.");
        return $this->applySkill($this->rapidStrike, $this->getStat("strength"));
    }

    public function takeDamage($damage)
    {
        $attackDamage = $this->applySkill($this->magicShield, $damage);
        return parent::takeDamage($attackDamage);
    }

    public function __toString()
    {
        return "Hero";
    }
}