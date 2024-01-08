<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    protected $statusCode = 200;

    /**
     * @return \Illuminate\Http\Response
     */
    public function getJsonResponse()
    {
        $response = [
            'errorCode' => $this->getCode(),
            'message' => $this->getMessage(),
            'version' => env('API_VERSION', 'dev')
        ];

        return response()->json($response, $this->statusCode);
    }
}
