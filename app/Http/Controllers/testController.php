<?php

namespace App\Http\Controllers;

use App\Example;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class testController extends Controller
{

    public function index()
    {
        $user  = Auth::user();
        $role = Role::findByName('admin');
        $role->givePermissionTo('manage.users');
        
       //$user->assignRole('admin');

    // $user_permissions = $user->getRoleNames();

       // $users = User::role('admin')->get();
        ddd($user_permissions);

       /*  $role = Role::create(['name'=>'super.admin']);
        $permission = Permission::create(['name' => 'manage.users']);
        $role->givePermissionTo($permission); */ 
    }

    public function test(Example $example)
    {
       // ddd($example);
    }
}
