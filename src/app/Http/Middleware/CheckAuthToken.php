<?php

namespace App\Http\Middleware;

use App\Response\ApiResponse;
use Closure;
use App\Enums\HttpStatus;
use Illuminate\Support\Facades\Auth;

class CheckAuthToken
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return ApiResponse::response(HttpStatus::HTTP_UNAUTHORIZED, 'Authentication failed');
        }

        return $next($request);
    }
}
