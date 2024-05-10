<?php

namespace App\Http\Middleware;

use App\Response\ApiResponse;
use Closure;
use HttpMessages;
use Illuminate\Support\Facades\Auth;

class CheckAuthToken
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return ApiResponse::response(HttpMessages::HTTP_UNAUTHORIZED, 'Authentication failed');
        }

        return $next($request);
    }
}
