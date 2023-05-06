<?php

namespace Http;

interface ResponseInterface
{
    /**
     * Returns body response
     *
     * @return string
     */
    public function getBody();

    /**
     * Returns response header.
     *
     * @return array
     */
    public function getHeaders();

    /**
     * Returns response status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Return true if the response data is JSON.
     *
     * @return bool
     */
    public function isJson();

    /**
     * Return JSON data if the response data is JSON.
     *
     * @return mixed
     */
    public function getJsonData();
}
