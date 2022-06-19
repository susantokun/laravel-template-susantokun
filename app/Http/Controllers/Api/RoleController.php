<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : RoleController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Wednesday, 15th June 2022 3:07:29 pm
 * | Last Modified   : Sunday, 19th June 2022 5:54:28 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Api\BaseController as BaseController;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_can_roles_view_superadmin = auth()->user()->can('roles view superadmin');
        $superadmin = auth()->user()->getRoleNames()->contains('superadmin');

        $data = Role::with('permissions')->orderBy('id', 'desc');

        if ($superadmin || $auth_can_roles_view_superadmin) {
            $data = $data;
        } else {
            $data->whereNotIn('name', ['superadmin']);
        }

        return $this->sendResponse($data->get(['id', 'name', 'guard_name']), __('role.roles') .' '. __('label.get_data_success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
