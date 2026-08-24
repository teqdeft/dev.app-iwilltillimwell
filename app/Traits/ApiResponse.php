<?php

namespace App\Traits;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

trait ApiResponse
{
    /**
     * HTTP Status Code
     *
     * @var string
     */
    protected $statusCode = Response::HTTP_OK;

    /**
     * Get the HTTP Status Code
     *
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the HTTP Status Code
     *
     * @param  string $statusCode
     * @return APIController
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Create JSON Response
     *
     * @param  array $data
     * @param  array=[] $headers
     * @return Response
     */
    public function response($data, $headers = [])
    {
        return response()->json($data, 200, $headers);
    }
    /**
     * Create Success JSON Response
     *
     * @param  array $data
     * @param  array=[] $headers
     * @return Response
     */
    public function successResponse($data = [], $headers = [])
    {
        $data["status"] = true;
        $data = $data + [
            'message' => "",
            'data' => []
        ];
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function failResponse($data = [], $errorCode = 500, $headers = [])
    {
        $data["status"] = false;
        $data = $data + [
            'message' => trans('messages.something_went_wrong'),
            'messages' => []
        ];

        $errorCode  = ($errorCode >= 200 || $errorCode <= 299) ? 500 : $errorCode;

        $this->setStatusCode($errorCode);

        return response()->json($data, $this->getStatusCode(), $headers);
    }
}