<?php

namespace App\DataAccess;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\UserAccountStatus;
use App\UserAccount;

class UserAccountDataAccess {

    /**
     * Create a new userAccount
     */
    public static function create($userId, $data = null) {
        /**
         * If data is not provided, create a default account.
         */
        $data = $data ? $data : array(
            'user_id' => $userId,
            'status_id' => UserAccountStatus::$REQUESTED,
            'name' => UserAccount::$INTERST,
            'begin_at' => Carbon::now(),
            'end_at' => Carbon::now()->addDays(365));   
        try {
            /**
             * Database Eloquent access
             */
            $userAccount = UserAccount::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_accounts_table.php 
             * migrations files sequentially for futher infos.
             */
            Log::error(json_encode($e));
            return false;
        }
        /**
         * Well userAccount is available.
         */
        return $userAccount;
    }

    /**
     * Update an existing userAccount
     */
    public static function update(UserAccount $userAccount, $data) {   
        try {
            /**
             * Database Eloquent access
             */
            $userAccount->fill($data);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_accounts_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * UserAccount is updated.
         */
        $userAccount->save();
        /**
         * Well userAccount is saved.
         */
        return $userAccount;
    }

    /**
     * Delete an existing userAccount
     */
    public static function delete(UserAccount $userAccount) {   
        try {
            /**
             * Database Eloquent access
             */
            $userAccount->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_accounts_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well userAccount is deleted.
         */
        return $userAccount;
    }

    /**
     * Fetch all userAccount
     */
    public static function all($fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $userAccounts = $fields ? 
                UserAccount::all($fields) :
                UserAccount::all();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_accounts_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well userAccounts are fetched.
         */
        return $userAccounts;
    }

    /**
     * Fetch an existing userAccount
     */
    public static function find($id, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $userAccount = $fields ? 
                UserAccount::findOrFail($id, $fields) :
                UserAccount::findOrFail($id);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_accounts_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well userAccount is fetched.
         */
        return $userAccount;
    }

}