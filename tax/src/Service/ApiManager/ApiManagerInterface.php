<?php
declare(strict_types = 1);

namespace App\Service\ApiManager;

interface ApiManagerInterface
{
    /**
     * @param $method
     * @return mixed
     */
    public function setUrl(string $method);

    /**
     * @return mixed
     */
    public function getData();
}