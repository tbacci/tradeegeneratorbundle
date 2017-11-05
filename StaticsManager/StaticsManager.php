<?php

namespace Tradee\GeneratorBundle\StaticsManager;

class StaticsManager {

    private $tradeeDir;

    public function __construct($rootDir)
    {
        $this->tradeeDir = realpath($rootDir . '/../tradee');
    }

    public function isInitialized(){
        return file_exists($this->tradeeDir);
    }
}