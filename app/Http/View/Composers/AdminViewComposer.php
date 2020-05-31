<?php

/* 
* Resposible for injection the common variabled to all views
*
*/

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View as View;

class AdminViewComposer
{
    public function __construct()
    {
        
    }

    public function compose(View $view)
    {
        $user = Auth::user();
        if($user){
            $user->unreadNotifications();
            $user->settings();
            $notifications = [
                'users_new' => 10,
                'messages_new' => 20,     
            ] ;
            $view->with('notifications', $notifications);
        }
    }
}

