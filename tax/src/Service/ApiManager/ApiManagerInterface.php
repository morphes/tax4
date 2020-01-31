<?php

namespace App\Service\ApiManager;

interface ApiManagerInterface
{
    /**
     * @param $method
     * @return mixed
     */
    public function setUrl($method);

    /**
     * @return mixed
     */
    public function getUrl();

    /**
     * @param $method
     * @return mixed
     */
    public function setMethod($method);

    /**
     * @return mixed
     */
    public function getMethod();

    /**
     * @return mixed
     */
    public function getData();
}