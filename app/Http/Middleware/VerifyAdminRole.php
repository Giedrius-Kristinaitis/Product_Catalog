<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth as Auth;
use App\User as User;

class VerifyAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$this->hasAdminRole($user)) {
            return redirect('home');
        }

        return $next($request);
    }

    /**
     * @param User $user User to verify
     *
     * @return bool true if the user has a role of an admin
     */
    private function hasAdminRole(User $user) : bool
    {
        foreach ($user->roles as $role)
        {
            if (strcmp($role->name, 'admin') == 0)
            {
                return true;
            }
        }

        return false;
    }
}
