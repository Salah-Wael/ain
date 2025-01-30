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
            new Middleware('role:Super-Admin', only: ['create', 'store', 'destroy']),
        ];
    }

    // Index method to display all permissions
    public function index()
    {
        $permissions = Permission::with('roles')->orderBy('permissions.name',)->get();
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
        // التحقق من صحة الإدخال
        $validatedData = $request->validate([
            'name' => 'required|string|max:255','roleArray' => 'required', // التأكد من أن roleArray مصفوفة
            // 'roleArray.*' => 'required|in:web,admin,doctor,head', // التحقق من الحراس الموجودة فقط
        ]);

        // إنشاء الإذن وربطه بالأدوار
        foreach (array_keys($validatedData['roleArray']) as $roleGuardName) {
            // إنشاء الإذن
            $permission = Permission::updateOrCreate([
                'name' => str_replace(' ', '_', strtolower($validatedData['name'])),
                'guard_name' => $roleGuardName,
            ]);

            // البحث عن الدور وربط الإذن به
            $assignedRole = Role::where('guard_name', $roleGuardName)->first();

            if ($assignedRole) {
                $assignedRole->givePermissionTo($permission);
            }
        }

        // إظهار رسالة نجاح
        Session::flash('success', 'Permission created successfully!');
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
