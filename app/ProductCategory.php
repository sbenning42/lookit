<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public static $LONGBOARD0 = 1;
    public static $LONGBOARD1 = 2;
    public static $LONGBOARD2 = 3;

    protected $fillable = [
        'name',
        'src'
    ];

    public function products() {
        return $this->hasMany('App\Product', 'category_id');
    }
}
