<?php

namespace Http;

require_once 'RequestInterface.php';

use Http\RequestInterface;

class Request implements RequestInterface
{
    /**
     * Request URL variable
     *
     * @var string
     */
    private $url;

    /**
     * Request options variable
     *
     * @var array
     */
    private $options;

    /**
     * Request constructor
     *
     * @param string $url
     * @param array $options
     */
    public function __construct($url, $options = [])
    {
        $this->url = $url;
        $this->options = $options;
    }

    /**
     * Set target url function
     *
     * @param string $url
     * @return RequestInterface
     */
    public function setUrl($url): RequestInterface
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Return target url stirng
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set request options function
     *
     * @param array $options
     * @return RequestInterface
     */
    public function setOptions($options): RequestInterface
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Return request options function
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
