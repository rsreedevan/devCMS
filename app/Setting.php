<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function userSettings()
    {
        $this->hasMany('App\UserSetting');
    }
}
