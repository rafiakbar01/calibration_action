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
        $middleware->authenticateSessions();
        $middleware->appendToGroup('web', \App\Http\Middleware\SingleSession::class);
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // ── Custom Error Pages ────────────────────────────────────────────────
        // Render halaman error custom untuk semua HTTP exception
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e, \Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return null; // Biarkan default JSON response untuk API
            }

            $code = $e->getStatusCode();
            $view = "errors.{$code}";

            // Cek apakah view untuk kode error tersebut tersedia
            if (view()->exists($view)) {
                return response()->view($view, ['exception' => $e], $code);
            }

            // Fallback ke halaman 500 jika view tidak tersedia
            if (view()->exists('errors.500')) {
                return response()->view('errors.500', ['exception' => $e], $code);
            }

            return null; // Fallback ke default Laravel jika semua gagal
        });
    })->create();
