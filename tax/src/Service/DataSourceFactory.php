<?php
declare(strict_types = 1);

namespace App\Service;

/**
 * Class DataSourceFactory
 *
 * @package App\Service
 */
class DataSourceFactory
{
    /**
     * @param string $method
     * @return mixed
     * @throws \Exception
     */
    public static function create(string $method)
    {
        $dataSource = new DataSource();
        return $dataSource->setMethod($method)->getInstance();
    }
}