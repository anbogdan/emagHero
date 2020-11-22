<?php

namespace EmagHero;

class Fight
{
    private int $turns;
    private array $players;

    public function __construct($turns)
    {
        $this->turns = $turns;
        $this->players = array();
        $this->initStats();
    }

    private function initStats()
    {
        array_push($this->players, new Hero(new Stats(realpath("config/hero_stats.json"))));
        array_push($this->players, new Monster(new Stats(realpath("config/monster_stats.json"))));
    }

    public function start()
    {
        $this->sortPlayers();
        while($this->turns > 0) {

            $this->turns -= 1;
        }
    }

    private function sortPlayers() {
        function cmp(Player $p1, Player $p2)
        {
            if ($p1->getStat("speed") == $p2->getStat("speed")) {
                if(($p1->getStat("luck") == $p2->getStat("speed"))) return 0;
                return ($p1->getStat("luck") < $p2->getStat("luck")) ? -1 : 1;
            }
            return ($p1->getStat("speed") < $p2->getStat("speed")) ? -1 : 1;
        }

        usort($this->players, "cmp");
    }
}