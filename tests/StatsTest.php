<?php

use EmagHero\Stats;
use PHPUnit\Framework\TestCase;

class StatsTest extends TestCase
{
    public function testGetExistingStat()
    {
        $stats = new Stats(realpath("test_config.json"));
        try {
            $this->assertIsInt($stats->getStat("health"));
        } catch (Exception $e) {
            exit($e);
        }
    }

    public function testGetNonexistentStat()
    {
        $stats = new Stats(realpath("test_config.json"));
        $this->expectException(Exception::class);
        $stats->getStat("foo");
    }

    public function testSetExistingStat()
    {
        $stats = new Stats(realpath("test_config.json"));
        $value = 40;
        $stats->setStat("health", $value);
        try {
            $this->assertEquals($stats->getStat("health"), $value);
        } catch (Exception $e) {
            exit($e);
        }
    }

    public function testSetNonexistentStat()
    {
        $stats = new Stats(realpath("test_config.json"));
        $value = 40;
        $stats->setStat("foo", $value);
        try {
            $this->assertEquals($stats->getStat("foo"), $value);
        } catch (Exception $e) {
            exit($e);
        }
    }
}