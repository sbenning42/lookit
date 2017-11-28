<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\UserAccount;

class JwtAuthController extends Controller
{
    public static $INTERST = 'interest';
    public static $CUSTOMER = 'customer';
    public static $DONATOR = 'donator';
    public static $VENDOR = 'vendor';
    public static $ADMIN = 'admin';
    public static $DEV = 'dev';
    private function _getLevel(UserAccount $userAccount) {
        return $userAccount->name === UserAccount::$INTERST ? 1 :
            $userAccount->name === UserAccount::$CUSTOMER ? 2 :
            $userAccount->name === UserAccount::$DONATOR ? 3 :
            $userAccount->name === UserAccount::$VENDOR ? 4 :
            $userAccount->name === UserAccount::$ADMIN ? 5 :
            $userAccount->name === UserAccount::$DEV ? 6 : 0;


    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
                $user = JWTAuth::toUser($token);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        // all good so return the token
        return response()->json([
            'token' => $token,
            'level' => $this->_getLevel($user->account),
            'id' => $user->id
        ], 200);
    }

    public function logout(Request $request) {
        JWTAuth::parseToken()->invalidate();
    }
}
