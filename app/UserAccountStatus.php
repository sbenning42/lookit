<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccountStatus extends Model
{
    public static $REQUESTED = 1;
    public static $VALIDATED = 2;
    public static $HONORED = 3;

    protected $fillable = [
        'name',
    ];

    public function userAccounts() {
        return $this->hasMany('App\UserAccount', 'status_id');
    }
}
