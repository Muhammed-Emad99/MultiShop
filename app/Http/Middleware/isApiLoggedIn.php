<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isApiLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (isset($request->access_token) && $request->access_token != null){
            $user = User::where('remember_token',$request->access_token)->first();
            return $next($request);
        }else{
            return response()->json(['error' =>'not valid user']);
        }
    }
}
