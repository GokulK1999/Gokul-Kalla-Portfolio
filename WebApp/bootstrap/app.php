<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Management;
use App\Http\Middleware\Operation;
use App\Http\Middleware\Client;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'management'=>Management::class,
            'operation'=>Operation::class,
            'client'=>Client::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
