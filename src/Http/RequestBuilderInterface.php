<?php

namespace Http;

require_once 'RequestInterface.php';

use Http\RequestInterface;

interface RequestBuilderInterface
{
    /**
     * Build request function
     *
     * @param string $method
     * @param string $url
     * @param mixed $payload
     * @param array $headers
     * @return RequestInterface
     */
    public static function build($method, $url, $payload = null, $headers = []);
}
