<?php


namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class BaseController extends Controller
{
    public function sendResponse($result)
    {
        $response = [
            'success' => true,
            'data' => $result
        ];

        return new JsonResponse($response);
    }

    /**
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return new JsonResponse($response, $code);
    }
}
