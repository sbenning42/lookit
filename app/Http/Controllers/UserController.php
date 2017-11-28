<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataAccess\UserDataAccess;

class UserController extends Controller
{

    private function _validateCreation(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'         
        ]);
    }
    private function _validateUpdate(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'       
        ]);
    }
    private function _prepareData(Request $request) {
        return array(
            'user_id' => $request->user_id,
            'email' => trim($request->email),
            'name' => trim($request->name),
            'password' => bcrypt($request->password)
        );
    }
    private function _prepareWith(Request $request) {
        $allowedWithKeys = [
            'accounts',
            'accounts.status'
        ];
        return isset($request->with) ?
            array_filter($request->with, function($withKey) use($allowedWithKeys) {
                return array_search($withKey, $allowedWithKeys) === false ? false : true;
            }) :
            null;
    }

    public function index(Request $request) {
        if ($with = $this->_prepareWith($request)) {
            $collection = UserDataAccess::allWith($with);
        } else {
            $collection = UserDataAccess::all();
        }
        return response()->json($collection, 200);
    }

    public function show(Request $request, $id) {
        if ($with = $this->_prepareWith($request)) {
            $user = UserDataAccess::findWith($id, $with);
        } else {
            $user = UserDataAccess::find($id);
        }
        return response()->json($user, 200);
    }

    public function store(Request $request) {
        $this->_validateCreation($request);
        $data = $this->_prepareData($request);
        $user = UserDataAccess::create($data);
        return response()->json($user, 200);
    }

    public function update(Request $request, $id) {
        $this->_validateUpdate($request);
        $data = $this->_prepareData($request);
        $user = UserDataAccess::find($id);
        $user = UserDataAccess::update($user, $data);
        return response()->json($user, 200);
    }

    public function delete(Request $request, $id) {
        $user = UserDataAccess::find($id);
        $user = UserDataAccess::delete($user);
        return response()->json([], 200);
    }

}
