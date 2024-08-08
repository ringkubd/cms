<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class permission
{
  /**
   * Handle an incoming request.
   *
   * @param Request $request
   * @param Closure $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $uri = $request->route()->uri();
    $method = $request->method();
    $menus = Admin::get_permitted_menus();
    $menus = $menus->where('route_uri', $uri)->where('method', $method)->first();
    if (!$menus) {
      abort(401);
    }
    return $next($request);
  }
}
