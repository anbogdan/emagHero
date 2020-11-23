<?php

namespace EmagHero;

use Monolog\Logger;

class Fight
{
    private int $turns;
    private array $players;
    private Logger $logger;

    public function __construct($turns, Logger $logger)
    {
        $this->logger = $logger;
        $this->turns = $turns;
        $this->players = array();
        $this->initStats();
    }

    private function initStats()
    {
        array_push($this->players, new Hero(new Stats(realpath("config/hero_stats.json")), $this->logger));
        array_push($this->players, new Monster(new Stats(realpath("config/monster_stats.json")), $this->logger));
    }

    public function start()
    {
        $this->sortPlayers();
        $attackerIndex = 0;
        $countRounds = 0;
        while($this->turns > 0) {
            for($x = 0; $x < count($this->players) and $this->turns > 0; $x++) {
                if($x == $attackerIndex) {
                    continue;
                }
                $this->logger->info("------------------- ROUND ".$countRounds." -------------------");
                $attackDamage = $this->players[$attackerIndex]->getAttack();
                $damageDone = $this->players[$x]->takeDamage($attackDamage);
                $this->logger->info("Damage done: ".$damageDone);
                if($this->players[$x]->getStat("health") < 0)
                {
                    $this->logger->info($this->players[$attackerIndex]." won because ".$this->players[$x].
                        "'s health got below 0.");
                    exit();
                }
                $this->logger->info("Defender's remaining health: ".$this->players[$x]->getStat("health"));
                $this->turns -= 1;
                $countRounds += 1;
            }
            $attackerIndex = ($attackerIndex + 1) % count($this->players);
        }
    }

    private function sortPlayers() {
        usort($this->players, array($this, "cmp"));
    }

    private function cmp(Player $p1, Player $p2)
    {
        if ($p1->getStat("speed") == $p2->getStat("speed")) {
            if(($p1->getStat("luck") == $p2->getStat("speed"))) return 0;
            return ($p1->getStat("luck") < $p2->getStat("luck")) ? -1 : 1;
        }
        return ($p1->getStat("speed") < $p2->getStat("speed")) ? -1 : 1;
    }
}