<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       // if (Gate::denies('dashboard.view')) 
        //    return redirect()->route('home')->withErrors('Not allowed');
        return View('admin.dashboard.index');
    }
}
