<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : PermissionController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Friday, 3rd June 2022 1:29:42 pm
 * | Last Modified   : Sunday, 19th June 2022 5:55:48 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions view', ['only' => ['index', 'show']]);
        $this->middleware('permission:permissions create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permissions edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permissions delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $can_permissions_delete = auth()->user()->can('permissions delete');
        $can_permissions_edit = auth()->user()->can('permissions edit');

        return view('backend.pages.permissions.index', [
            'can_permissions_delete' => $can_permissions_delete,
            'can_permissions_edit' => $can_permissions_edit,
        ]);
    }

    public function create()
    {
        $permissionsOperation = [
            'view',
            'create',
            'edit',
            'delete',
        ];

        return view('backend.pages.permissions.create', compact('permissionsOperation'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        if ($request->input('permissionsOperation')) {
            foreach ($request->input('permissionsOperation') as $value) {
                Permission::create(['name' => $request->input('name').' '.$value]);
            }
        } else {
            Permission::create(['name' => $request->input('name')]);
        }

        return redirect()->route('accounts.permissions.index')
            ->with('success', __('permission.store_success'));
    }

    public function show($id)
    {
        $permission = Permission::find($id);

        return view('backend.pages.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('backend.pages.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();

        return redirect()->route('accounts.permissions.index')
            ->with('success', __('permission.update_success'));
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json([
            'status'  => true,
            'message' => __('permission.destroy_success'),
        ]);
    }
}
