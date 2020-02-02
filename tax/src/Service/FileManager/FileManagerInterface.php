<?php
declare(strict_types = 1);

namespace App\Service\FileManager;

/**
 * Interface ApiManagerInterface
 *
 * @package App\Service\ApiManager
 */
interface FileManagerInterface
{
    /**
     * @param string $method
     * @return mixed
     */
    public function setPath(string $method);

    /**
     * @return mixed
     */
    public function getData();
}