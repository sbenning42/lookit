<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductPicture extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'order',
        'origin_name',
        'origin_abs_fs_path',
        'origin_http_public_path',
        'origin_size',
        'origin_type',
        'thumb_name',
        'thumb_abs_fs_path',
        'thumb_http_public_path',
        'thumb_size',
        'thumb_type',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'origin_abs_fs_path', 'thumb_abs_fs_path',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}