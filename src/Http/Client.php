<?php

namespace Http;

require_once 'ClientInterface.php';
require_once 'RequestInterface.php';
require_once 'RequestBuilder.php';
require_once 'Response.php';

use Http\RequestBuilder;
use Http\RequestInterface;
use Http\ClientInterface;

class Client implements ClientInterface
{
    /**
     * GET request.
     *
     * @param string $url Request URL
     * @param array $payload Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function get($url, $payload = null, $headers = [])
    {
        return self::send(RequestInterface::METHOD_GET, $url, $payload, $headers);
    }

    /**
     * POST request.
     *
     * @param string $url Request URL
     * @param array $payload Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function post($url, $payload = null, $headers = [])
    {
        return self::send(RequestInterface::METHOD_POST, $url, $payload, $headers);
    }

    /**
     * PUT request.
     *
     * @param string $url Request URL
     * @param array $payload Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function put($url, $payload = null, $headers = [])
    {
        return self::send(RequestInterface::METHOD_PUT, $url, $payload, $headers);
    }

    /**
     * DELETE request.
     *
     * @param string $url Request URL
     * @param array $payload Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function delete($url, $payload = null, $headers = [])
    {
        return self::send(RequestInterface::METHOD_DELETE, $url, $payload, $headers);
    }

    /**
     * HEAD request.
     *
     * @param string $url Request URL
     * @param array $payload Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function head($url, $payload = null, $headers = [])
    {
        return self::send(RequestInterface::METHOD_HEAD, $url, $payload, $headers);
    }

    /**
     * OPTIONS request.
     *
     * @param string $url Request URL
     * @param array $payload Request body
     * @param array $headers Request headers
     * @return mixed
     * @throws\Exception
     */
    public static function options($url, $payload = null, $headers = [])
    {
        return self::send(RequestInterface::METHOD_OPTIONS, $url, $payload, $headers);
    }

    /**
     * Sends HTTP request.
     *
     * @param string $method Method (GET, POST, etc.)
     * @param string $url Request URL
     * @param array $payload Request body
     * @param array $headers Request headers
     * @return HTTP_Response
     * @throws\Exception
     */
    public static function send($method, $url, $payload = null, $headers = [])
    {
        /**
         * @var RequestInterface $request
         */
        $request = RequestBuilder::build($method, $url, $payload, $headers);
        $context = stream_context_create($request->getOptions());

        $url = $request->getUrl();
        $result = file_get_contents($url, false, $context);

        $response = new Response($result, $http_response_header);
        if ($result === false) {
            $status = $response->getStatus();
            if (strpos($status, '2') !== 0 && strpos($status, '3') !== 0) {
                throw new \Exception("Unexpected response status: {$status} while fetching {$url}\n" . $status);
            }
        }
        return $response;
    }
}
