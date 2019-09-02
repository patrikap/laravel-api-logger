<?php

namespace Patrikap\ApiLogger;

use Patrikap\ApiLogger\Contracts\LogProfile;

class DefaultLogProfile implements LogProfile
{
    public function init()
    {
        request()->headers->set('X-ApiLogger-RequestId', uniqid());
        request()->headers->set('X-ApiLogger-StartTime', microtime(true));
    }

    public function shouldLogRequest(\Illuminate\Http\Request $request): bool
    {
        return in_array(strtolower($request->method()), config('api-logger.logged_methods'));
    }
}