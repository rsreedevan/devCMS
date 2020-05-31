<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = ['setting_key_id', 'setting_key', 'value', 'uid'];

    public function user()
    {
        $this->hasOne('App\User');
    }
    
}
