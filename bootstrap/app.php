<?php

use App\Http\Middleware\ApiSecurity;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ApiSecurity::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $ex) {
            if(env("APP_ENVIRONMENT") == "debug") {
                return response(content: [
                    'message' => $ex->getMessage(),
                    'data' => $ex->getTrace()
                ], status: 500);
            }
    
            return response(content: [
                'message' => $ex->getMessage(),
                'data' => null
            ], status: 500);
        });
    })->create();
