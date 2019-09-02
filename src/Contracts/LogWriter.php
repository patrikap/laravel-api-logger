<?php

namespace Patrikap\ApiLogger\Contracts;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param Response $response
     * @return mixed
     */
    public function logResponse(Response $response);
}