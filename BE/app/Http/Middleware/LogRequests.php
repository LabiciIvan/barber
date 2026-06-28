<?php

namespace App\Http\Middleware;

use App\Http\Helpers\UserAgentParser;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $data = [
            'method'              => $request->method(),
            'url'                 => $request->fullUrl(),
            'ip'                  => $request->ip(),
            'user_id'             => $request->user()?->id ?? 'guest',
            'body'                => $request->except(['password', 'password_confirmation']),
            'status'              => $response->getStatusCode(),
            'user_agent'          => $request->userAgent(),
            'client'              => UserAgentParser::parse($request->userAgent()),
        ];

        Log::channel('requests')->info(
            "\n" . json_encode($data, JSON_PRETTY_PRINT)
        );
        return $next($request);
    }
}
