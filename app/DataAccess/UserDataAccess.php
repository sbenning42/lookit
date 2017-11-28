<?php

namespace App\DataAccess;

use Carbon\Carbon;

use App\User;

class UserDataAccess {

    /**
     * Create a new user
     */
    public static function create($data) {
        try {
            /**
             * Database Eloquent access
             */
            $user = User::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well user is available.
         */
        return $user;
    }

    /**
     * Update an existing user
     */
    public static function update(User $user, $data) {   
        try {
            /**
             * Database Eloquent access
             */
            $user->fill($data);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * User is updated.
         */
        $user->save();
        /**
         * Well user is saved.
         */
        return $user;
    }

    /**
     * Delete an existing user
     */
    public static function delete(User $user) {   
        try {
            /**
             * Database Eloquent access
             */
            $user->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well user is deleted.
         */
        return $user;
    }

    /**
     * Fetch all users
     */
    public static function all($fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $users = $fields ? 
                User::all($fields) :
                User::all();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well users are fetched.
         */
        return $users;
    }

    /**
     * Fetch an existing user
     */
    public static function find($id, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $user = $fields ? 
                User::findOrFail($id, $fields) :
                User::findOrFail($id);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well user is fetched.
         */
        return $user;
    }

    /**
     * Fetch all users with
     */
    public static function allWith($withs, $fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $users = $fields ? 
                User::with($withs)->get($fields) :
                User::with($withs)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well users are fetched.
         */
        return $users;
    }

    /**
     * Fetch an existing user
     */
    public static function findWith($id, $withs, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $user = $fields ? 
                User::with($withs)->whereIn('id', [$id])->firstOrFail($fields) :
                User::with($withs)->whereIn('id', [$id])->firstOrFail();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_user_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well user is fetched.
         */
        return $user;
    }

}