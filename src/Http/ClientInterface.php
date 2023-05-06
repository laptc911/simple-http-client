<?php

namespace Http;

interface ClientInterface
{

    /**
     * GET request.
     *
     * @param string $url Request URL
     * @param array $body Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */

    public static function get($url, $body = null, $headers = []);

    /**
     * POST request.
     *
     * @param string $url Request URL
     * @param array $body Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function post($url, $body = null, $headers = []);

    /**
     * PUT request.
     *
     * @param string $url Request URL
     * @param array $body Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function put($url, $body = null, $headers = []);

    /**
     * DELETE request.
     *
     * @param string $url Request URL
     * @param array $body Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function delete($url, $body = null, $headers = []);

    /**
     * HEAD request.
     *
     * @param string $url Request URL
     * @param array $body Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function head($url, $body = null, $headers = []);

    /**
     * OPTIONS request.
     *
     * @param string $url Request URL
     * @param array $body Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function options($url, $body = null, $headers = []);

    /**
     * Sends HTTP request.
     *
     * @param string $method Method (GET, POST, etc.)
     * @param string $url Request URL
     * @param array $body Request body
     * @param array $headers Request headers
     * @return HTTP_Response
     * @throws\Exception
     */
    public static function send($method, $url, $body = null, $headers = []);
}
