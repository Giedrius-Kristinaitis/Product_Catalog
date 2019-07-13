<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyImageMimeType
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
        $mime_type = $request->file('image')->getMimeType();

        if ($mime_type != 'image/png' && $mime_type != 'image/jpeg')
        {
            return redirect()->back()->withErrors(['Bad image file']);
        }

        return $next($request);
    }
}
