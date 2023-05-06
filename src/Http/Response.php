<?php

namespace Http;

require_once 'ResponseInterface.php';

use Http\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * Response raw body
     *
     * @var string
     */
    private $body;

    /**
     * Response header
     *
     * @var array
     */
    private $headers;

    /**
     * Response constructor function
     *
     * @param string $body
     * @param array $headers
     */
    public function __construct($body, $headers = [])
    {
        $this->body = $body;
        $this->headers = $headers;
    }

    /**
     * Returns body response
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Returns response header.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Returns response status.
     *
     * @return int
     */
    public function getStatus()
    {
        $statusHeader = implode(',', $this->headers);
        preg_match('{HTTP\/\S*\s(\d{3})}', $statusHeader, $match);
        return $match[1];
    }

    /**
     * Return true if the response data is JSON.
     *
     * @return bool
     */
    public function isJson()
    {
        return strpos(strtolower(implode(', ', $this->headers)), 'application/json') !== false;
    }

    /**
     * Return JSON data if the response data is JSON.
     *
     * @return mixed
     * @throws\Exception On json_decode errors
     */
    public function getJsonData()
    {
        $result = json_decode($this->body, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $result;
        } else {
            throw new \Exception("Error decoding JSON: " . json_last_error());
        }
    }
}
