<?php

namespace Http;

require_once 'Request.php';
require_once 'RequestInterface.php';
require_once 'RequestBuilderInterface.php';

use Http\Request;
use Http\RequestInterface;
use Http\RequestBuilderInterface;

class RequestBuilder implements RequestBuilderInterface
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
    public static function build($method, $url, $payload = null, $headers = [])
    {
        $options = [
            'http' => [
                'method' => $method,
            ],
        ];

        $method = strtoupper($method);
        $headers = array_change_key_case($headers, CASE_LOWER);

        switch ($method) {
            case RequestInterface::METHOD_HEAD:
            case RequestInterface::METHOD_OPTIONS:
            case RequestInterface::METHOD_GET:
                if (is_array($payload)) {
                    if (strpos($url, '?') !== false) {
                        $url .= '&';
                    } else {
                        $url .= '?';
                    }

                    $url .= urldecode(http_build_query($payload));
                }
                break;
            case RequestInterface::METHOD_DELETE:
            case RequestInterface::METHOD_PUT:
            case RequestInterface::METHOD_POST:
                if (is_array($payload)) {
                    if (!empty($headers['content-type'])) {
                        switch (trim($headers['content-type'])) {
                            case RequestInterface::CONTENT_TYPE_FORM_URLENCODED:
                                $payload = http_build_query($payload);
                                break;
                            case RequestInterface::CONTENT_TYPE_JSON:
                                $payload = json_encode($payload);
                                break;
                        }
                    } else {
                        $headers['content-type'] = RequestInterface::CONTENT_TYPE_FORM_URLENCODED;
                        $payload = http_build_query($payload);
                    }
                } elseif (empty($headers['content-type'])) {
                    $headers['content-type'] = RequestInterface::CONTENT_TYPE_FORM_URLENCODED;
                }
                $options['http']['content'] = $payload;
                break;
        }

        if ($headers) {
            $options['http']['header'] = implode(
                "\r\n",
                array_map(
                    function ($v, $k) {
                        return sprintf("%s: %s", $k, $v);
                    },
                    $headers,
                    array_keys($headers)
                )
            );
        }
        return new Request($url, $options);
    }
}
