<?php 
//  Admin notification service container
namespace App;
use App\User;
use App\Notifications\Admin\Users\Created as UserCreated;
use App\Notifications\Admin\Users\Destroyed as UserDestroyed;

class AdminNotifier 
{
    private $_admin;
    public $user;
    public $type;

    public function __construct()
    {
        $this->_admin = User::findOrFail(1);
    }

    public function notify()
    {
        switch($this->type){
            case 'user.created':
                $this->_admin->notify(new UserCreated($this->data));
            break;
            case 'user.destroyed':
                $this->_admin->notify(new UserDestroyed($this->data));
            break;

        }
    }
}