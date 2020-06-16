<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\User\CreateRequest as UserCreateRequest;
use App\Http\Requests\Admin\User\UpdateRequest as UserUpdateRequest;

class UserController extends Controller
{
      
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * index
     *
     * @return void
     */
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
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(UserCreateRequest $request)
    {   
       try{

            $user =  User::create($request->all());
            if($request->roles)
                $user->syncRoles($request->roles);
            if($request->permissions)
                $user->syncPermissions($request->permissions);
            return redirect()->route('users')->with(['success' => 'User created successfully']);
            
        } 
        catch( Exception $e)
        {
            throw new Exception("Error Processing Request", 1);

        }
    }
    
    /**
     * edit
     *
     * @param  mixed $user
     * @return void
     */
    public function edit(User $user)
    {
        if(Gate::allows('user.edit',$user))
        {
            // User is allowed to edit only his profile 
            return View('admin.user.edit',[
                'user' => $user->format(),
                'page_title' => 'Manage Users',
                'roles' => Role::all(),
                'permissions' => Permission::all()
            ]);
        }
        else
            return new Exception('Not Authorised');
        
    }

    
    /**
     * update
     *
     * @param  mixed $user
     * @param  mixed $request
     * @return void
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        if($request->post())
        {   
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
    }

    
    /**
     * destroy
     *
     * @param  mixed $user
     * @return void
     */
    public function destroy(User $user)
    {
        if($user->delete())
            return back()->with('success', 'User deleted successfully');
        else 
            return back()->withErrors('Unable to delete the user');
    }
    
    /**
     * roles
     *
     * @return void
     */
    public function roles()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return View('admin.user.roles', ['roles' => $roles, 'page_title' => 'Manag User Roles', 'permissions' => $permissions]);
    }
    
    /**
     * role_create
     *
     * @param  mixed $request
     * @return void
     */
    public function role_create(Request $request)
    {
        $request->validate([
            'role_name' => ['required']
        ]);

        $role = Role::create(['name' => $request->role_name]);
        $role->syncPermissions($request->role_permissions);

        return redirect()->back()->with('success', 'Role created successfully');
    }
    
    /**
     * roleDestroy
     *
     * @param  mixed $role
     * @return void
     */
    public function roleDestroy(Role $role) 
    {
        if($role->delete()) 
            return redirect()->route('roles')->with('success', 'Role deleted successfully');
        else 
        return redirect()->route('roles')->with('error', 'Unable to delete the role');   
    }


}
