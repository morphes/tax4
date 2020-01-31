<?php

namespace App\Service\FileManager;

/**
 * Interface ApiManagerInterface
 *
 * @package App\Service\ApiManager
 */
interface FileManagerInterface
{
    /**
     * @param $method
     * @return mixed
     */
    public function setPath($method);

    /**
     * @return mixed
     */
    public function getData();
}