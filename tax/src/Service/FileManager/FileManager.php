<?php
declare(strict_types = 1);

namespace App\Service\FileManager;

/**
 * Class ApiManager
 *
 * @package App\Service\ApiManager
 */
class FileManager implements FileManagerInterface
{
    /**
     * @var
     */
    private $path;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return FileManager
     */
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getData(): string
    {
        if(file_exists($this->getPath())) {
            return file_get_contents($this->getPath());
        }
        throw new \Exception('File not found!');
    }
}