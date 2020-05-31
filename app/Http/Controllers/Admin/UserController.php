<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\User\Created as UserCreated;
use App\Notifications\User\Destroyed as UserDestroyed;
use App\User;
use Exception;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\AdminNotifier;

class UserController extends Controller
{
    private $_adminNotifier;
    public function __construct(AdminNotifier $adminNotifier)
    {
        $this->_adminNotifier = $adminNotifier;
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return View('admin.user.list', [
            'users' => $users->map->format(),
            'page_title' => 'Manage Users',
            'roles' => Role::all(),
            'permissions' => Permission::all()
            ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => ['email','unique:users','required'],
            'name' => ['required']
        ]);

       try{
           $user =  User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
                ]
            );

            // Add roles 
            if($request->roles)
                $user->syncRoles($request->roles);

            // Assign Explisit Permissions
            if($request->permissions)
                $user->syncPermissions($request->permissions);

            // Notify user about the account
            $user->notify(new UserCreated());

            $this->_adminNotifier->type = 'user.created';
            $this->_adminNotifier->data = $user;
            $this->_adminNotifier->notify();

            return redirect()->route('users')->with(['success' => 'User created successfully']);
            
        } 
        catch( Exception $e)
        {
            throw new Exception("Error Processing Request", 1);

        }
    }

    public function edit($id, Request $request)
    {
        

        if($request->post())
        {   
            $user = User::findOrFail($id);
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email']
            ]);
            if ($user->update(
                [
                    'name' => $request->name,
                    'emai' => $request->email
                ]))
                {
                    $user->syncRoles($request->roles);
                    $user->syncPermissions($request->permissions);
                }
            return redirect()->back()->with('success', 'User updated successfully');
        }
        $user = User::findOrFail($id)->format();
        if(Gate::allows('user.edit',$user))
        {
            // User is allowed to edit only his profile 
            return View('admin.user.edit',[
                'user' => $user,
                'page_title' => 'Manage Users',
                'roles' => Role::all(),
                'permissions' => Permission::all()
            ]);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->notify(new UserDestroyed());

        $this->_adminNotifier->type = 'user.destroyed';
        $this->_adminNotifier->data = $user;
        $this->_adminNotifier->notify();

        if(User::destroy($id))
            return back()->with('success', 'User deleted successfully');
        else 
            return back()->withErrors('Unable to delete the user');
    }

    public function roles()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return View('admin.user.roles', ['roles' => $roles, 'page_title' => 'Manag User Roles', 'permissions' => $permissions]);
    }

    public function role_create(Request $request)
    {
        $request->validate([
            'role_name' => ['required']
        ]);

        $role = Role::create(['name' => $request->role_name]);
        $role->syncPermissions($request->role_permissions);

        return redirect()->back()->with('success', 'Role created successfully');
    }

    public function roleDestroy($id) 
    {
        Role::destroy($id);
        return redirect()->route('roles')->with('success', 'Role deleted successfully');
    }


}
