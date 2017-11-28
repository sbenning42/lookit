<?php

namespace App\Http\Middleware;

use Closure;

use Carbon\Carbon;

use App\UserAccount;

class RoleMiddleware
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
        $now = Carbon::now();
        foreach ($request->userAuth->accounts as $account) {
            if ($now < $account->begin_at || $now > $account->end_at) { continue ; }
            if ($account->name === 'admin' || $account->name === 'dev') { return $next($request); }
        }
        return response()->json(['error' => 'restricted_area'], 401);
    }
}
