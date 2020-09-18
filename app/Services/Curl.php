<?php


namespace App\Services;


use App\Exceptions\RequestException;
use App\Interfaces\IRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

class Curl implements IRequest
{

    /**
     * @param $method
     * @param $url
     * @param $headers
     * @param $params
     * @return array
     * @throws RequestException
     */
    public function send($method, $url, $params, $headers = [])
    {
        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER     => $headers,
        );

        $ch = curl_init();

        if ($method == 'GET') {
            $options[CURLOPT_URL] = "$url?" . http_build_query($params, null, '&', PHP_QUERY_RFC1738);
        } else {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $params;
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $error = curl_error($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($error || $httpCode >= 400) {
            throw new RequestException('request error', $httpCode, $response);
        }

        return json_decode($response);
    }
}
