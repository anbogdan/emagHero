<?php

use EmagHero\Fight;
use EmagHero\MyLogger;
use EmagHero\Player;
use EmagHero\Stats;
use PHPUnit\Framework\TestCase;

class FightTest extends TestCase
{
    public function testSortPlayerHigherSpeed()
    {
        $logger = MyLogger::getInstance();
        $stats = new Stats(realpath("tests/test_config.json"));
        $player1 = new Player($stats, $logger);
        $player2 = new Player($stats, $logger);
        $player1->setStat("speed", 10);
        $player2->setStat("speed", 20);
        $players = array($player1, $player2);
        Fight::sortPlayers($players);
        $this->assertEquals($players[0], $player2);
    }
}