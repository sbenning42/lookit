<?php

namespace App\Observers;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\User;
use App\UserAccountStatus;
use App\UserAccount;
use App\DataAccess\UserAccountDataAccess;

class UserObserver
{
    public $createdErrorMsg = '::: UserObserver@created: No userAccount created for User ::: ';
    public $deletingErrorMsg = '::: UserObserver@deleting: UserAccount wasn\'t deleted for User ::: ';

    /**
     * UserAccount define part of users "rights".
     * Each user must have at least one for history and management purpose.
     */
    private function _createUserAccountFor(User $user) {
        $userAccount = array(
            'user_id' => $user->id,
            'status_id' => UserAccountStatus::$REQUESTED,
            'name' => UserAccount::$INTERST,
            'begin_at' => Carbon::now(),
            'end_at' => Carbon::now()->addDays(365) 
        );
        if (UserAccountDataAccess::create(0, $userAccount) === false) {
            Log::error($this->createdErrorMsg, ['user' => $user]);
        }
    }

    /**
     * Explicite delete onCascade processing
     */
    private function _deteleAllUserAccountsOf(User $user) {
        $collection = $user->accounts;
        foreach ($collection as $userAccount) {
            if (UserAccountDataAccess::delete($userAccount) === false) {
                Log::error($this->deletingErrorMsg, ['userAccount' => $userAccount, 'user' => $user]);
            }
        }
    }

    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->_createUserAccountFor($user);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        $this->_deteleAllUserAccountsOf($user);
    }
}