<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckBlocked;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. Ongeza CheckBlocked kwenye mfumo mzima wa web
        // Hii inamfanya mtumiaji aliyeblokiwa atolewe nje (logout) mara moja anapobofya chochote
        $middleware->web(append: [
            CheckBlocked::class,
        ]);

        // 2. Majina ya utani ya middleware zako
        $middleware->alias([
            'admin'     => \App\Http\Middleware\AdminMiddleware::class,
            'craftsmen' => \App\Http\Middleware\CraftsmenMiddleware::class,
            'blocked'   => CheckBlocked::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();