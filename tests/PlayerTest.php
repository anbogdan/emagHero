<?php

use EmagHero\MyLogger;
use EmagHero\Player;
use EmagHero\Stats;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testTakeDamage()
    {
        $logger = MyLogger::getInstance();
        $stats = new Stats(realpath("tests/test_config.json"));
        $player = new Player($stats, $logger);
        $player->setStat("health", 100);
        $player->setStat("defence", 30);
        $player->takeDamage(40);
        $this->assertEquals(90, $player->getStat("health"));
    }

    public function testTakeNegativeDamage()
    {
        $logger = MyLogger::getInstance();
        $stats = new Stats(realpath("tests/test_config.json"));
        $player = new Player($stats, $logger);
        $player->setStat("health", 100);
        $player->setStat("defence", 30);
        $player->takeDamage(-15);
        $this->assertEquals(100, $player->getStat("health"));
    }

    public function testNegativeDefence()
    {
        /* Damage = Attacker strength – Defender defence */
        $logger = MyLogger::getInstance();
        $stats = new Stats(realpath("tests/test_config.json"));
        $player = new Player($stats, $logger);
        $player->setStat("health", 100);
        $player->setStat("defence", -20);
        $player->takeDamage(10);
        $this->assertEquals(70, $player->getStat("health"));
    }

    public function testNegativeDamageNegativeDefence()
    {
        /* Damage = Attacker strength – Defender defence */
        $logger = MyLogger::getInstance();
        $stats = new Stats(realpath("tests/test_config.json"));
        $player = new Player($stats, $logger);
        $player->setStat("health", 100);
        $player->setStat("defence", -20);
        $player->takeDamage(-10);
        $this->assertEquals(90, $player->getStat("health"));
    }
}