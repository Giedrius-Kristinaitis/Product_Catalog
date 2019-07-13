<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProductHasStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // this needs to be done because if the 'enabled' checkbox is left unchecked,
        // it's value won't be submitted at all and product status won't update
        if (!array_key_exists('enabled', $request->all()))
        {
            $request->request->add(['enabled' => false]);
        }

        return $next($request);
    }
}
