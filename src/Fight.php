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
        Fight::sortPlayers($this->players);
        $attackerIndex = 0;
        $countRounds = 0;
        while($countRounds < $this->turns) {
            for($x = 0; $x < count($this->players) and $countRounds < $this->turns; $x++) {
                if($x == $attackerIndex) {
                    continue;
                }
                $this->round($attackerIndex, $x, $countRounds);
                $countRounds += 1;
            }
            $attackerIndex = ($attackerIndex + 1) % count($this->players);
        }
    }

    public function round($attacker, $defender, $number)
    {
        $this->logger->info("------------------- ROUND ".$number." -------------------");
        $attackDamage = $this->players[$attacker]->getAttack();
        $damageDone = $this->players[$defender]->takeDamage($attackDamage);
        $this->logger->info("Damage done: ".$damageDone);
        if($this->players[$defender]->getStat("health") < 0)
        {
            $this->logger->info($this->players[$attacker]." won because ".$this->players[$defender].
                "'s health got below 0.");
            exit();
        }
        $this->logger->info("Defender's remaining health: ".$this->players[$defender]->getStat("health"));
    }

    static public function sortPlayers($players) {
        usort($players, array(Fight::class, "cmp"));
    }

    static private function cmp(Player $p1, Player $p2)
    {
        if ($p1->getStat("speed") == $p2->getStat("speed")) {
            if(($p1->getStat("luck") == $p2->getStat("speed"))) return 0;
            return ($p1->getStat("luck") < $p2->getStat("luck")) ? -1 : 1;
        }
        return ($p1->getStat("speed") < $p2->getStat("speed")) ? -1 : 1;
    }
}