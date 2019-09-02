<?php

namespace Patrikap\ApiLogger\Contracts;

use Illuminate\Http\Request;

interface LogProfile
{
    /**
     * инициирует логгер, выставляет флаги
     */
    public function init();

    /**
     * говорит что можно логировать что нет
     * @param Request $request
     * @return bool
     */
    public function shouldLogRequest(Request $request): bool;
}