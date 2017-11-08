<?php

namespace Tradee\GeneratorBundle\StaticsManager;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Finder\Finder;

class StaticsManager
{

    private $projectDir;
    private $tradeeDir;
    private $files;

    public function __construct($rootDir)
    {
        $this->projectDir = realpath($rootDir . '/../');
        $this->tradeeDir = $this->projectDir . '/tradee';
        $this->findFiles();
    }

    public function initialize()
    {
        if (!file_exists($this->tradeeDir)) {
            try {
                $this->checkAccess();
            } catch (Exception $e) {
                throw new StaticsManagerException($e . ' Please create tradee folder');
            }
            mkdir($this->tradeeDir);
        }

        $infos = [
            'version' => '0.1'
        ];

        $this->writeJson('infos.json', $infos);
        $this->findFiles();

        $relativePaths =
            array_values(
                array_map(function ($file) {
                    return $file->getRelativePathname();
                }, $this->files)
            );

            sort($relativePaths);

        $this->writeJson('files.json', $relativePaths);
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
            throw new StaticsManagerException('Tradee not initialized');
        }
    }

    private function checkAccess()
    {
        if (!is_writable($this->projectDir)) {
            throw new StaticsManagerException('Project dir "' . $this->projectDir .
                ' is not writable');
        }
    }

    public function isInitialized()
    {
        return file_exists($this->tradeeDir);
    }

    private function findFiles()
    {
        $finder = new Finder();
        $finder
            ->in($this->projectDir)
            ->exclude(['vendor'])
            ->files()
            ->name('*.yml');

        $this->files = iterator_to_array($finder->getIterator());

    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param mixed $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }
}