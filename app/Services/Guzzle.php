<?php


namespace App\Services;


use App\Exceptions\RequestException;
use App\Interfaces\IRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

class Guzzle implements IRequest
{

    /**
     * @inheritDoc
     */
    public function send($method, $url, $params = [], $headers = [])
    {
        $client = new Client();

        try {
            $response = $client->request($method, $url, ['query' => $params]);

            return json_decode($response->getBody());
        } catch (ClientException $e) {
            $data = null;

            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $data = [
                    'code' => $response->getStatusCode(),
                    'message' => $response->getReasonPhrase()
                ];
            }

            throw new RequestException('request client error', $e->getCode(), $data);
        } catch (ServerException | GuzzleException $e) {
            throw new RequestException('request server error', $e->getCode());
        }
    }
}
