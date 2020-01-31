<?php

namespace App\Service;

/**
 * Class DataSourceFactory
 *
 * @package App\Service
 */
class DataSourceFactory
{
    /**
     * @param $method
     * @return mixed
     * @throws \Exception
     */
    public static function create($method)
    {
        $dataSource = new DataSource();
        return $dataSource->setMethod($method)->getInstance();
    }
}