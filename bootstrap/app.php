<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 🎯 KUNCI AMAN 405 & 401 FIX: 
        // Beritahu Laravel 11 untuk mempercayai headers proxy dari Ngrok (* berarti semua proxy, aman untuk lokal/demo)
        // Ini bikin request POST upload dan GET preview Livewire sinkron jalurnya di internet HP lo
        $middleware->trustProxies(at: '*');
        
        // Pengecualian CSRF untuk Livewire
        $middleware->validateCsrfTokens(except: [
            'livewire/*',
            'livewire-tmp/*',
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();