<?php

class Stats
{
    public function __construct($configLocation)
    {
        $config = file_get_contents($configLocation);
        $configJson = json_decode($config);
        foreach($configJson as $k => $v) {
            $this->setProperty($k, mt_rand($v["min"], $v["max"]));
        }
    }

    public function setProperty($name, $value){
        $this->{$name} = $value;
    }
}