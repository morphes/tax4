<?php
namespace App\Service\ApiManager;

use Symfony\Component\HttpClient\HttpClient;

/**
 * Class ApiManager
 *
 * @package App\Service\ApiManager
 */
class ApiManager implements ApiManagerInterface
{
    /**
     * @var
     */
    private $method = 'GET';

    /**
     * @var
     */
    private $url;

    /**
     * @var
     */
    private $headers;

    /**
     * @var
     */
    private $content;

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return ApiManager
     */
    public function setMethod($method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return ApiManager
     */
    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param $headers
     * @return ApiManager
     */
    public function setHeaders($headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content
     * @return ApiManager
     */
    public function setContent($content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getData()
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request(
            $this->getMethod(), $this->getUrl(), [
                'headers' => $this->getHeaders(),
                'query' => $this->getContent()
            ]
        );
        return $response->getContent();
    }
}