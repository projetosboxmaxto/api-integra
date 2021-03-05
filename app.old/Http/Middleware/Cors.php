<?php

namespace App\Http\Middleware;
use Closure;
class Cors
{
  public function handle($request, Closure $next)
  {
     ini_set('memory_limit', '1024M');
            
            
    return $next($request)
      ->header("Access-Control-Allow-Origin", "*")
      ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
      ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization");
  }
}