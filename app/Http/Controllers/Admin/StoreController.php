<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $stores =  Store::all();
       return View('admin.store.list',['stores' => $stores, 'page_title' => 'Manage Stores']);
    }
}
