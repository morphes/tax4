<?php
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
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $path
     * @return FileManager
     */
    public function setPath($path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return false|mixed|string
     * @throws \Exception
     */
    public function getData()
    {
        if(file_exists($this->getPath())) {
            return file_get_contents($this->getPath());
        }
        throw new \Exception('File not found!');
    }
}