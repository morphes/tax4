<?php
declare(strict_types = 1);

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
     * @var string
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
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return ApiManager
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return ApiManager
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    /**
     * @param $headers
     * @return ApiManager
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param $content
     * @return ApiManager
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getData(): string
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