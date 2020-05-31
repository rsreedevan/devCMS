<?php

namespace App\Http\Admin\Controllers;

use App\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_settings = UserSetting::where('uid', Auth::id())->get();
        ddd($user_settings);
    }
}
