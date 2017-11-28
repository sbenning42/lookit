<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'category_id', 'name', 'description', 'price'
        ];
    
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
        ];
    
        protected $dates = [
            'deleted_at'
        ];
    
        public function category() {
            return $this->belongsTo('App\ProductCategory', 'category_id');
        }

        public function pictures() {
            return $this->hasMany('App\ProductPicture', 'product_id')
                ->orderBy('order', 'ASC');
        }
}
