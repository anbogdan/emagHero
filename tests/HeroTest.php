<?php

use EmagHero\Hero;
use EmagHero\MyLogger;
use EmagHero\Stats;
use PHPUnit\Framework\TestCase;

class HeroTest extends TestCase
{
    public function testGetAttackIsInt()
    {
        $logger = MyLogger::getInstance();
        $stats = new Stats(realpath("test_config.json"));
        $hero = new Hero($stats, $logger);
        $this->assertIsInt($hero->getAttack());
    }

    public function testTakeDamageIsInt()
    {
        $logger = MyLogger::getInstance();
        $stats = new Stats(realpath("test_config.json"));
        $hero = new Hero($stats, $logger);
        $value = 10.5;
        $this->assertIsInt($hero->takeDamage($value));
    }
}