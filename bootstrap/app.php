<?php

use App\Http\Middleware\Demo;
use App\Http\Middleware\Access;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'access' => Access::class,
            'demo' => Demo::class
        ]);

        $middleware->validateCsrfTokens(except: [
            '/game/like_game','game/dislike_game'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
