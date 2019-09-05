<?php

namespace Patrikap\ApiLogger\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface LogWriter
{
    /**
     * логирует запрос
     * @param Request $request
     * @return mixed
     */
    public function logRequest(Request $request);

    /**
     * логирует ответ
     * @param JsonResponse $response
     * @return mixed
     */
    public function logResponse(JsonResponse $response);
}