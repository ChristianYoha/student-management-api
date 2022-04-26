<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $apiToken = $request->header('api-token');
        $user = User::where('api_token', $apiToken)->get()->first();
        if( !$user instanceof User){
            return response()->json('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
