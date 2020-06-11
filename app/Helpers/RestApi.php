<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RestApi
{
    /**
     * Return response with json object
     *
     * @param $responseObject , $responseKey, $statusCode
     * @param int $statusCode
     * @param string $responseKey
     * @return JsonResponse
     */
    public function sendJson($responseObject, $statusCode = Response::HTTP_OK, $responseKey = 'response')
    {
        $jsonResponse['statusCode'] = $statusCode;
        if ($responseObject)
            $jsonResponse[$responseKey] = $responseObject;
        return response($jsonResponse, $statusCode);
    }


    /**
     * Return response with error object
     *
     * @param $errorObject , $errorKey, $statusCode
     * @param int $statusCode
     * @param string $errorKey
     * @return JsonResponse
     */
    public function sendError($errorObject, $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY, $errorKey = 'error')
    {
        $errorResponse['statusCode'] = $statusCode;
        $errorResponse[$errorKey] = $errorObject;
        return response($errorResponse, $statusCode);
    }

    public function sendRedirectError($errorObject, $statusCode = Response::HTTP_PERMANENTLY_REDIRECT, $errorKey = 'error')
    {
        $errorResponse['statusCode'] = $statusCode;
        $errorResponse[$errorKey] = $errorObject;
        return response($errorResponse, $statusCode);
    }

    /**
     * Return a response with a message.
     *
     * @param $responseObject
     * @param int $statusCode
     * @param string $responseKey
     * @return Response
     */
    public function sendMessage($responseObject, $statusCode = Response::HTTP_ACCEPTED, $responseKey = 'response')
    {
        $jsonResponse['statusCode'] = $statusCode;
        if ($responseObject)
            $jsonResponse[$responseKey] = $responseObject;
        return response($jsonResponse, $statusCode);
    }
}