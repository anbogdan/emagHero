<?php

namespace EmagHero;

interface Skill
{
    function __construct($chance, $logger);
    public function try($stat);
}