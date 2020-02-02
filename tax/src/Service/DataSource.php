<?php
declare(strict_types = 1);

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
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return DataSource
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }
}