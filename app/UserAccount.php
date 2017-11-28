<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use SoftDeletes;

    public static $INTERST = 'interest';
    public static $CUSTOMER = 'customer';
    public static $DONATOR = 'donator';
    public static $VENDOR = 'vendor';
    public static $ADMIN = 'admin';
    public static $DEV = 'dev';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status_id', 'name', 'begin_at', 'end_at'
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

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function status() {
        return $this->belongsTo('App\UserAccountStatus', 'status_id');
    }
}
