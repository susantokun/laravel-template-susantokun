<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : UserController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Friday, 17th June 2022 10:23:56 am
 * | Last Modified   : Sunday, 19th June 2022 5:54:38 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Api\BaseController as BaseController;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        $search = $request->search;
        $per_page = $request->per_page;
        $orderBy = $request->order_by ?? 'created_at';
        $orderType =  $request->order_type ?? 'DESC';

        $auth_can_users_view_superadmin = auth()->user()->can('users view superadmin');
        $superadmin = auth()->user()->getRoleNames()->contains('superadmin');

        $data = User::orderBy($orderBy, "$orderType");
        $data->with('roles', fn ($query) => $query->select('id', 'name'));

        if ($superadmin || $auth_can_users_view_superadmin) {
            $data->when($search, function ($query) use ($search) {
                $query->orWhereHas('roles', function (Builder $query) use ($search) {
                    $query->whereIn('name', ["{$search}"]);
                })->orWhere('email', 'like', "%{$search}%");
            });
        } else {
            $data->whereDoesntHave('roles', function (Builder $query) use ($search) {
                $query->whereIn('name', ['superadmin']);
            })->when($search, function ($query) use ($search) {
                $query->whereDoesntHave('roles', function (Builder $query) use ($search) {
                    $query->whereNotIn('name', ["{$search}"]);
                })->where('email', 'like', "%{$search}%");
            });
        }

        $users = $data->paginate($per_page);

        return $this->sendResponse($users, __('user.users') .' '. __('label.get_data_success'));
    }
}
