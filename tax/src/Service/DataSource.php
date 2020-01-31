<?php

namespace App\Service;

/**
 * Class DataSource
 *
 * @package App\Service
 */
class DataSource
{
    /**
     * @var
     */
    private $method;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getInstance()
    {
        $method = ucfirst($this->method) . 'Manager';
        $className = __NAMESPACE__ . '\\' .  $method . '\\' . $method;
        if(class_exists($className)) {
            return new $className();
        } else {
            throw new \Exception('Source '. $this->method . ' not found');
        }
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return DataSource
     */
    public function setMethod($method): self
    {
        $this->method = $method;
        return $this;
    }
}