<?php

namespace EmagHero;

class Fight
{
    private int $rounds;

    public function __construct($rounds)
    {
        $this->rounds = $rounds;
        $this->initStats();
    }

    private function initStats()
    {
        $hero = new Hero(new Stats(realpath("config/hero_stats.json")));
        $monster = new Monster(new Stats(realpath("config/monster_stats.json")));
    }

    public function start() {

    }
}