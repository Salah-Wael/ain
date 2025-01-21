<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller implements HasMiddleware
{
    public $guardsArray = ['web', 'admin','doctor', 'head'];
    // Ensure admin middleware is applied to protect Permission operations
    public static function middleware(): array
    {
        return [
            // new Middleware('', only: ['index']),
            // new Middleware('', except: ['store']),
        ];
    }

    // Index method to display all permissions
    public function index()
    {
        $permissions = Permission::with('roles')->orderBy('permissions.gua')->get();
        return view('back.permissions.index', compact('permissions'));
    }

    // Create method to show form for creating a new Permission
    public function create()
    {
        $roles = Role::get();
        return view('back.permissions.create', compact('roles'))->with(['guardsArray' => $this->guardsArray]);
    }

    // Store method to save the new Permission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            'roleArray.*' => 'nullable',
        ]);

        $permission = Permission::create([
            'name' => str_replace(' ', '_', strtolower( $request->name)),
            'guard_name' => $request->guard_name,
        ]);

        if ($request->has('roleArray')) {

            $roles = Role::whereIn('name', array_keys($request->roleArray))->get();  // Get roles based on Names
            foreach ($roles as $role) {
                $role->givePermissionTo($permission);
            }
        }

        Session::flash('success', 'Permission created successfully!');
        return redirect()->route('back.permissions.index');
    }

    // Edit method to show the form for editing an existing Permission
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::get();

        return view('back.permissions.edit', compact('permission', 'roles'))
            ->with(['guardsArray' => $this->guardsArray]);
    }

    // Update method to save changes to the Permission
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            'roleArray.*' => 'nullable',
        ]);

        // Update the permission
        $permission->update([
            'name' => str_replace(' ', '_', strtolower($request->name)),
            'guard_name' => $request->guard_name,
        ]);

        // Sync roles
        $roles = array_keys($request->input('roleArray', []));
        $permission->syncRoles($roles);  // syncRoles will update the roles associated with the permission

        Session::flash('success', 'Permission updated successfully!');
        return redirect()->route('back.permissions.index');
    }

    // Destroy method to delete a Permission
    public function destroy($id)
    {
        $Permission = Permission::findOrFail($id);
        $Permission->delete();

        Session::flash('success', 'Permission deleted successfully!');
        return redirect()->route('back.permissions.index');
    }
}
