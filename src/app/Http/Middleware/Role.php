<?php

namespace App\Http\Middleware;

use App\Enums\HttpStatus;
use App\Enums\UserRoleType;
use App\Providers\RouteServiceProvider;
use App\Response\ApiResponse;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class Role
{
    /**
     * @param $request
     * @param Closure $next
     * @param ...$roles
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector|mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $userId = Auth::user()->getAuthIdentifier();
        $user = User::find($userId);

        foreach($roles as $role) {
            // Check if user has the role
            // This check will depend on how your roles are set up
            if($user['roleId'] == (int) $role)
                return $next($request);
        }

        return ApiResponse::response(HttpStatus::HTTP_UNAUTHORIZED, 'Access Denied. You do not have the required role.');
    }
}
