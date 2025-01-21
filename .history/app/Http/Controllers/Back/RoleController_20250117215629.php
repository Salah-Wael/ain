<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class RoleController extends Controller
{
    public $guardsArray = ['web', 'admin', ];
    const DIRECTORY = 'back.roles';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->getData($request->all());
        return view(self::DIRECTORY . ".index", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Get data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData($data)
    {
        $order   = $data['order'] ?? 'created_at';
        $sort    = $data['sort'] ?? 'desc';
        $perpage = $data['perpage'] ?? \config('app.paginate');
        $start   = $data['start'] ?? null;
        $end     = $data['end'] ?? null;
        $word    = $data['word'] ?? null;

        $data = Role::with('permissions')
            ->when($word != null, function ($q) use ($word) {
                $q->where('name', 'like', '%' . $word . '%');
            })
            ->when($start != null, function ($q) use ($start) {
                $q->whereDate('created_at', '>=', $start);
            })
            ->when($end != null, function ($q) use ($end) {
                $q->whereDate('created_at', '<=', $end);
            })
            ->orderby($order, $sort)->paginate($perpage);

        return \get_defined_vars();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Permission::where('guard_name', 'admin')->get();
        return view(self::DIRECTORY . ".create", get_defined_vars())
            ->with(['directory' => self::DIRECTORY, 'guardsArray' => $this->guardsArray]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create([
            'name' => str_replace(' ', '-', ucwords(strtolower($data['name']))),
            'guard_name' => $data['guard_name'], // Accessing array element correctly
        ]);

        if (isset($data['permissionArray'])) {
            $role->givePermissionTo(array_keys($data['permissionArray']));
        }

        return redirect()->route('back.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $groups = Permission::where('guard_name', 'admin')->get();
        return view(self::DIRECTORY . ".edit", \get_defined_vars())
            ->with(['directory' => self::DIRECTORY, 'guardsArray' => $this->guardsArray]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update([
            'name' => str_replace(' ', '-', ucwords(strtolower($data['name']))),
        ]);


        $role->syncPermissions();
        if (isset($data['permissionArray'])) {
            // foreach ($data['permissionArray'] as $permission => $value) {
            $role->givePermissionTo(array_keys($data['permissionArray']));
            // }
        }
        return redirect()->route('back.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->syncPermissions();
        $role->delete();
        return redirect()->route('back.roles.index');
    }
}
