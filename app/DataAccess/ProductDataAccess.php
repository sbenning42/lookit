<?php

namespace App\DataAccess;

use Carbon\Carbon;

use App\Product;

class ProductDataAccess {

    /**
     * Create a new product
     */
    public static function create($data) {
        try {
            /**
             * Database Eloquent access
             */
            $product = Product::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_product_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well product is available.
         */
        return $product;
    }

    /**
     * Update an existing product
     */
    public static function update(Product $product, $data) {   
        try {
            /**
             * Database Eloquent access
             */
            $product->fill($data);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_product_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Product is updated.
         */
        $product->save();
        /**
         * Well product is saved.
         */
        return $product;
    }

    /**
     * Delete an existing product
     */
    public static function delete(Product $product) {   
        try {
            /**
             * Database Eloquent access
             */
            $product->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_product_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well product is deleted.
         */
        return $product;
    }

    /**
     * Fetch all product
     */
    public static function all($fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $products = $fields ? 
                Product::all($fields) :
                Product::all();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_product_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well products are fetched.
         */
        return $products;
    }

    /**
     * Fetch an existing product
     */
    public static function find($id, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $product = $fields ? 
                Product::findOrFail($id, $fields) :
                Product::findOrFail($id);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_product_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well product is fetched.
         */
        return $product;
    }

        /**
     * Fetch all products with
     */
    public static function allWith($withs, $fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $products = $fields ? 
                Product::with($withs)->get($fields) :
                Product::with($withs)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_product_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well products are fetched.
         */
        return $products;
    }

    /**
     * Fetch an existing product
     */
    public static function findWith($id, $withs, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $product = $fields ? 
                Product::with($withs)->whereIn('id', [$id])->firstOrFail($fields) :
                Product::with($withs)->whereIn('id', [$id])->firstOrFail();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_product_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well product is fetched.
         */
        return $product;
    }

}