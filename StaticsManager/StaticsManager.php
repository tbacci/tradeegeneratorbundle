<?php

namespace Tradee\GeneratorBundle\StaticsManager;

use Symfony\Component\Config\Definition\Exception\Exception;

class StaticsManager
{

    private $projectDir;
    private $tradeeDir;

    public function __construct($rootDir)
    {
        $this->projectDir = realpath($rootDir . '/../');
        $this->tradeeDir = $this->projectDir . '/tradee';
    }

    public function initialize()
    {
        if (!file_exists($this->tradeeDir)) {
            try{
                $this->checkAccess();
            }catch (Exception $e){
                throw new \StaticsManagerException($e . ' Please create tradee folder');
            }
            mkdir($this->tradeeDir);
        }

        $infos = [
            'version' => '0.1'
        ];

        $this->writeJson('infos.json', $infos);
    }

    private function writeJson($filename, $datas)
    {
        $this->checkInitialization();
        $this->checkAccess();

        return file_put_contents($this->tradeeDir . '/' . $filename, json_encode($datas));
    }

    private function checkInitialization()
    {
        if (!$this->isInitialized()) {
            throw new \StaticsManagerException('Tradee not initialized');
        }
    }

    private function checkAccess()
    {
        if (!is_writable($this->projectDir)) {
            throw new \StaticsManagerException('Project dir "' . $this->projectDir .
                ' is not writable');
        }
    }

    public function isInitialized()
    {
        return file_exists($this->tradeeDir);
    }

    private function findFiles($directory, $extensions = array()) {
        function glob_recursive($directory, &$directories = array()) {
            foreach(glob($directory, GLOB_ONLYDIR | GLOB_NOSORT) as $folder) {
                $directories[] = $folder;
                glob_recursive("{$folder}/*", $directories);
            }
        }
        glob_recursive($directory, $directories);
        $files = array ();
        foreach($directories as $directory) {
            foreach($extensions as $extension) {
                foreach(glob("{$directory}/*.{$extension}") as $file) {
                    $files[$extension][] = $file;
                }
            }
        }
        return $files;
    }
}