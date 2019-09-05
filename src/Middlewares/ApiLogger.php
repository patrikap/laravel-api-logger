<?php

namespace Patrikap\ApiLogger\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Patrikap\ApiLogger\Contracts\LogProfile;
use Patrikap\ApiLogger\Contracts\LogWriter;

class ApiLogger
{
    protected $logProfile;
    protected $logWriter;

    public function __construct(LogProfile $logProfile, LogWriter $logWriter)
    {
        $this->logProfile = $logProfile;
        $this->logWriter = $logWriter;
    }

    public function handle(Request $request, Closure $next)
    {
        if (config('api-logger.enabled') && $this->logProfile->shouldLogRequest($request)) {
            $this->logProfile->init();
            $this->logWriter->logRequest($request);
        }

        return $next($request);
    }

    public function terminate(Request $request, $response)
    {
        if (config('api-logger.enabled') && $this->logProfile->shouldLogRequest($request)) {
            $this->logWriter->logResponse($response);
        }
    }
}