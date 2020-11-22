<?php

namespace EmagHero;

use Exception;

class Stats
{
    public function __construct($configLocation)
    {
        $config = file_get_contents($configLocation);
        $configJson = json_decode($config, true);
        foreach($configJson as $k => $v) {
            $this->setProperty($k, mt_rand($v["min"], $v["max"]));
        }
    }

    private function setProperty($name, $value){
        $this->{$name} = $value;
    }

    public function getStat($stat) {
        if (isset($this->$stat)) {
            return $this->$stat;
        }
        throw new Exception($stat." is not defined.");
    }

}