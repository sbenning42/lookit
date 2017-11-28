<?php

namespace App\DataAccess;

use Carbon\Carbon;

use App\UserAccountStatus;

class UserAccountStatusDataAccess {

    /**
     * Fetch all userAccountStatuss
     */
    public static function all($fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $userAccountStatuss = $fields ? 
                UserAccountStatus::all($fields) :
                UserAccountStatus::all();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_userAccountStatus_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well userAccountStatuss are fetched.
         */
        return $userAccountStatuss;
    }

    /**
     * Fetch an existing userAccountStatus
     */
    public static function find($id, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $userAccountStatus = $fields ? 
                UserAccountStatus::findOrFail($id, $fields) :
                UserAccountStatus::findOrFail($id);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_userAccountStatus_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well userAccountStatus is fetched.
         */
        return $userAccountStatus;
    }

    /**
     * Fetch all userAccountStatuss with
     */
    public static function allWith($withs, $fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $userAccountStatuss = $fields ? 
                UserAccountStatus::with($withs)->get($fields) :
                UserAccountStatus::with($withs)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_userAccountStatus_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well userAccountStatuss are fetched.
         */
        return $userAccountStatuss;
    }

    /**
     * Fetch an existing userAccountStatus
     */
    public static function findWith($id, $withs, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $userAccountStatus = $fields ? 
                UserAccountStatus::with($withs)->whereIn('id', [$id])->firstOrFail($fields) :
                UserAccountStatus::with($withs)->whereIn('id', [$id])->firstOrFail();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_userAccountStatus_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well userAccountStatus is fetched.
         */
        return $userAccountStatus;
    }

}
