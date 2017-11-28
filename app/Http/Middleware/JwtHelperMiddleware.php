<?php

namespace App\Http\Middleware;

use Closure;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtHelperMiddleware
{
    private function _getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return [
                    'user' => null,
                    'msg' => 'user_not_found',
                    'status' => 404
                ];
            }
    
        } catch (TokenExpiredException $e) {
    
            return [
                'user' => null,
                'msg' => 'token_expired',
                'status' => $e->getStatusCode()
            ];
    
        } catch (TokenInvalidException $e) {
    
            return [
                'user' => null,
                'msg' => 'token_invalid',
                'status' => $e->getStatusCode()
            ];
    
        } catch (JWTException $e) {
    
            return [
                'user' => null,
                'msg' => 'token_absent',
                'status' => $e->getStatusCode()
            ];
    
        }
        // the token is valid and we have found the user via the sub claim
        return [
            'user' => $user,
            'msg' => 'user authenticate',
            'status' => 200
        ];
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authentication = $this->_getAuthenticatedUser();
        $request->userAuth = $authentication['user'];
        return $request->userAuth ?
            $next($request) :
            response()->json(['error' => $authentication['msg']], $authentication['status']);
    }

}
