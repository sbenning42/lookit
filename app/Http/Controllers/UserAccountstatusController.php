<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataAccess\UserAccountStatusDataAccess;

class UserAccountstatusController extends Controller
{
    private function _prepareWith(Request $request) {
        $allowedWithKeys = [
            'user-accounts',
            'user-accounts.status',
            'user-accounts.user',
        ];
        return isset($request->with) ?
            array_filter($request->with, function($withKey) use($allowedWithKeys) {
                return array_search($withKey, $allowedWithKeys) === false ? false : true;
            }) :
            null;
    }

    public function index(Request $request) {
        if ($with = $this->_prepareWith($request)) {
            $collection = UserAccountStatusDataAccess::allWith($with);
        } else {
            $collection = UserAccountStatusDataAccess::all();
        }
        return response()->json($collection, 200);
    }

    public function show(Request $request, $id) {
        if ($with = $this->_prepareWith($request)) {
            $userAccountStatus = UserAccountStatusDataAccess::findWith($id, $with);
        } else {
            $userAccountStatus = UserAccountStatusDataAccess::find($id);
        }
        return response()->json($userAccountStatus, 200);
    }
}
