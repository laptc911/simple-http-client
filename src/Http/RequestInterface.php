<?php

namespace Http;

interface RequestInterface
{
    const METHOD_GET = "GET";
    const METHOD_POST = "POST";
    const METHOD_PUT = "PUT";
    const METHOD_DELETE = "DELETE";
    const METHOD_HEAD = "HEAD";
    const METHOD_OPTIONS = "OPTIONS";

    const CONTENT_TYPE_JSON = "application/json";
    const CONTENT_TYPE_FORM_URLENCODED = "application/x-www-form-urlencoded";

    /**
     * Set target url function
     *
     * @param string $url
     * @return RequestInterface
     */
    public function setUrl($url): RequestInterface;

    /**
     * Return target url stirng
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Set request options function
     *
     * @param array $options
     * @return RequestInterface
     */
    public function setOptions($options): RequestInterface;

    /**
     * Return request options function
     *
     * @return array
     */
    public function getOptions(): array;
}
