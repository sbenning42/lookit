<?php

namespace App\DataAccess;

use Carbon\Carbon;

use App\ProductCategory;

class ProductCategoryDataAccess {

    /**
     * Fetch all productCategorys
     */
    public static function all($fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $productCategorys = $fields ? 
                ProductCategory::all($fields) :
                ProductCategory::all();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productCategory_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productCategorys are fetched.
         */
        return $productCategorys;
    }

    /**
     * Fetch an existing productCategory
     */
    public static function find($id, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $productCategory = $fields ? 
                ProductCategory::findOrFail($id, $fields) :
                ProductCategory::findOrFail($id);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productCategory_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productCategory is fetched.
         */
        return $productCategory;
    }

    /**
     * Fetch all productCategorys with
     */
    public static function allWith($withs, $fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $productCategorys = $fields ? 
                ProductCategory::with($withs)->get($fields) :
                ProductCategory::with($withs)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productCategory_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productCategorys are fetched.
         */
        return $productCategorys;
    }

    /**
     * Fetch an existing productCategory
     */
    public static function findWith($id, $withs, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $productCategory = $fields ? 
                ProductCategory::with($withs)->whereIn('id', [$id])->firstOrFail($fields) :
                ProductCategory::with($withs)->whereIn('id', [$id])->firstOrFail();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productCategory_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productCategory is fetched.
         */
        return $productCategory;
    }

}
