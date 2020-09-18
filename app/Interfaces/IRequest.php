<?php


namespace App\Interfaces;


interface IRequest
{
    /**
     * @param $method
     * @param $url
     * @param $params
     * @param $headers
     * @return array
     * @throws \App\Exceptions\RequestException;
     */
    public function send($method, $url, $params = [], $headers = []);
}
