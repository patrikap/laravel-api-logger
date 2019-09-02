# Log API requests
Log API requests in Laravel applications

## Installation

You can install the package via composer:

```bash
composer require patrikap/laravel-api-logger
```

Optionally you can publish the configfile with:

```bash
php artisan vendor:publish --provider="Patrikap\ApiLogger\ApiLoggerServiceProvider" --tag="config" 
```

## Usage

This packages provides a middleware which can be added as a global middleware or as a single route.

```php
// in `app/Http/Kernel.php`

protected $middleware = [
    // ...
    
    \Patrikap\ApiLogger\Middlewares\ApiLogger::class
];
```

```php
// in a routes file

Route::post('/submit-form', function () {
    //
})->middleware(\Patrikap\ApiLogger\Middlewares\ApiLogger::class);
```

### Logging

Two classes are used to handle the logging of incoming requests: 
a `LogProfile` class will determine whether the request should be logged,
and `LogWriter` class will write the request to a log. 

A default log implementation is added within this package. 
It will only log `GET`, `POST`, `PUT`, `PATCH`, and `DELETE` requests 
and it will write to the default Laravel logger.

You're free to implement your own log profile and/or log writer classes, 
and configure it in `config/api-logger.php`.

A custom log profile must implement `\Patrikap\ApiLogger\LogProfile`. 
This interface requires you to implement `shouldLogRequest`.

```php
// Example implementation from `\Patrikap\ApiLogger\DefaultLogProfile`

public function shouldLogRequest(Request $request): bool
{
   return in_array(strtolower($request->method()), config('api-logger.logged_methods'));
}
```

A custom log writer must implement `\Patrikap\ApiLogger\LogWriter`. 
This interface requires you to implement `logRequest` and `logResponse`.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

# Author
 
[Patrikap](https://github.com/patrikap)

# Inspiration

This project was inspired by the following projects:

- [Spatie HTTP Logger](https://github.com/spatie/laravel-http-logger)