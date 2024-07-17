<?php

namespace App\Http\Middleware;

use App\Http\Controllers\WebMainController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnderConstruction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $config = WebMainController::getWebConfig(0);
        if($config->web_status != 1){
            if(!\Auth::user()){
                return redirect()->route('UnderConstruction');
            }
        }

        return $next($request);
    }
}
