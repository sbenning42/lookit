<?php

namespace App\DataAccess;

use Carbon\Carbon;

use App\ProductPicture;

class ProductPictureDataAccess {

    /**
     * Create a new productPicture
     */
    public static function create($data) {
        try {
            /**
             * Database Eloquent access
             */
            $productPicture = ProductPicture::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productPicture_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productPicture is available.
         */
        return $productPicture;
    }

    /**
     * Update an existing productPicture
     */
    public static function update(ProductPicture $productPicture, $data) {   
        try {
            /**
             * Database Eloquent access
             */
            $productPicture->fill($data);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productPicture_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * ProductPicture is updated.
         */
        $productPicture->save();
        /**
         * Well productPicture is saved.
         */
        return $productPicture;
    }

    /**
     * Delete an existing productPicture
     */
    public static function delete(ProductPicture $productPicture) {   
        try {
            /**
             * Database Eloquent access
             */
            $productPicture->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productPicture_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productPicture is deleted.
         */
        return $productPicture;
    }

    /**
     * Fetch all productPictures
     */
    public static function all($fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $productPictures = $fields ? 
                ProductPicture::all($fields) :
                ProductPicture::all();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productPicture_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productPictures are fetched.
         */
        return $productPictures;
    }

    /**
     * Fetch an existing productPicture
     */
    public static function find($id, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $productPicture = $fields ? 
                ProductPicture::findOrFail($id, $fields) :
                ProductPicture::findOrFail($id);
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productPicture_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productPicture is fetched.
         */
        return $productPicture;
    }

    /**
     * Fetch all productPictures with
     */
    public static function allWith($withs, $fields = null) {   
        try {
            /**
             * Database Eloquent access
             */
            $productPictures = $fields ? 
                ProductPicture::with($withs)->get($fields) :
                ProductPicture::with($withs)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productPicture_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productPictures are fetched.
         */
        return $productPictures;
    }

    /**
     * Fetch an existing productPicture
     */
    public static function findWith($id, $withs, $fields = null) {
        try {
            /**
             * Database Eloquent access
             */
            $productPicture = $fields ? 
                ProductPicture::with($withs)->whereIn('id', [$id])->firstOrFail($fields) :
                ProductPicture::with($withs)->whereIn('id', [$id])->firstOrFail();
        } catch (\Illuminate\Database\QueryException $e) {
            /**
             * See xxx_productPicture_table.php 
             * migrations files sequentially for futher infos.
             */
            return false;
        }
        /**
         * Well productPicture is fetched.
         */
        return $productPicture;
    }

}