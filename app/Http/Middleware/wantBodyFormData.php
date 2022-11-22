<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class wantBodyFormData
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
        if($request->header('Accept')!='multipart/form-data'){
            return response()->json(['message'=>'Only Form Data Allowed!'],400);
        }
        return $next($request);
    }
}
