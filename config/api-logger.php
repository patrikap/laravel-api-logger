<?php
return [
    /**
     * флаг включения логирования
     */
    'enabled'        => env('API_LOGGER_ENABLED', true),
    /*
     * The log profile which determines whether a request should be logged.
     * It should implement `LogProfile`.
     */
    'log_profile'    => \Patrikap\ApiLogger\DefaultLogProfile::class,
    /*
     * The log writer used to write the request to a log.
     * It should implement `LogWriter`.
     */
    'log_writer'     => \Patrikap\ApiLogger\DefaultLogWriter::class,
    /*
     * Filter out body fields which will never be logged.
     */
    'except'         => [
        'password',
        'password_confirmation',
    ],
    /**
     * методы для логирования
     * ['get', 'head', 'post', 'put', 'delete', 'connect', 'options', 'trace', 'patch']
     */
    'logged_methods' => ['get', 'post', 'put', 'delete', 'patch'],
];