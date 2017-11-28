<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataAccess\UserAccountDataAccess;

class UserAccountController extends Controller
{
    public function index(Request $request) {
        $collection = UserAccountDataAccess::all();
        return response()->json($collection, 200);
    }

    public function show(Request $request, $id) {
        $userAccount = UserAccountDataAccess::find($id);
        return response()->json($userAccount, 200);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id', 
            'status_id' => 'required|exists:user_account_statuses,id',
            'name' => 'required',
            'begin_at' => 'required',
            'end_at' => 'required'          
        ]);
        $data = array(
            'user_id' => $request->user_id,
            'status_id' => $request->status_id,
            'name' => trim($request->name),
            'begin_at' => $request->begin_at,
            'end_at' => $request->end_at
        );
        UserAccountDataAccess::create($request->user_id, $data);
        return response()->json($userAccount, 200);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:user_account_statuses,id',
            'name' => 'required',
            'begin_at' => 'required',
            'end_at' => 'required'
        ]);
        $data = array(
            'user_id' => $request->user_id,
            'status_id' => $request->status_id,
            'name' => trim($request->name),
            'begin_at' => $request->begin_at,
            'end_at' => $request->end_at
        );
        $userAccount = UserAccountDataAccess::find($id);
        $userAccount = UserAccountDataAccess::update($userAccount, $data);
        return response()->json($userAccount, 200);
    }

    public function delete(Request $request, $id) {
        $userAccount = UserAccountDataAccess::find($id);
        $userAccount = UserAccountDataAccess::delete($userAccount);
        return response()->json([], 200);
    }
}
