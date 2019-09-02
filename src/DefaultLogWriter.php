<?php

namespace Patrikap\ApiLogger;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Patrikap\ApiLogger\Contracts\LogWriter;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DefaultLogWriter implements LogWriter
{
    public function logRequest(Request $request)
    {
        $endTime = microtime(true);
        $request_id = resolve('request_id');
        $uri = $request->getPathInfo();
        $method = strtoupper($request->getMethod());
        $bodyAsJson = json_encode($request->except(config('api-logger.except')));
        $files = array_map(function (UploadedFile $file) {
            return $file->getClientOriginalName();
        }, iterator_to_array($request->files));
        $startTime = resolve('start_time');
        $message = "Request: #{$request_id}" . PHP_EOL;
        $message .= "{$method} {$uri} - Body: {$bodyAsJson} - Files: " . implode(', ', $files);
        $message .= PHP_EOL . "Start time: {$startTime}, End time: {$endTime}";
        Log::info($message);
    }

    public function logResponse(Response $response)
    {
        $endTime = microtime(true);
        $request_id = resolve('request_id');
        $startTime = resolve('start_time');
        $message = "Response: #{$request_id}" . PHP_EOL;
        $message .= $response->getContent();
        $message .= PHP_EOL . "Start time: {$startTime}, End time: {$endTime}";
        Log::info($message);
    }
}