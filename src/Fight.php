<?php

class Fight
{
    public function __construct()
    {

    }

    private function initStats()
    {
        $hero = new Hero(new Stats("../hero_stats.json"));
        $monster = new Monster(new Stats("../monster_stats.json"));
    }
}