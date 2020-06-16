<?php

namespace App\Observers;

use App\AdminNotifier;
use App\User;
use App\Notifications\User\Created as UserCreated;
use App\Notifications\User\Destroyed as UserDestroyed;
class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $adminNotifier = new AdminNotifier();
        $user->notify(new UserCreated());
        $adminNotifier->type = 'user.created';
        $adminNotifier->data = $user;
        $adminNotifier->notify();

    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $adminNotifier = new AdminNotifier();
        $user->notify(new UserDestroyed());
        $adminNotifier->type = 'user.destroyed';
        $adminNotifier->data = $user;
        $adminNotifier->notify();
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
