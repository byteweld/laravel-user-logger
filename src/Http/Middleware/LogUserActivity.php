<?php

declare(strict_types=1);

namespace Byteweld\LaravelUserLogger\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Byteweld\LaravelUserLogger\Facades\UserLogger;

class LogUserActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldLog($request)) {
            UserLogger::logFromRequest($request);
        }

        return $response;
    }

    protected function shouldLog(Request $request): bool
    {
        return !in_array(
            $request->path(),
            config('user-logger.except.routes', []),
            true
        );
    }
}