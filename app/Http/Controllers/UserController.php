<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function basic(Request $request)
    {
        $users = User::orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            return response()->json([
                'data' => $users,
            ]);
        }

        return view('backend.pages.users.userBasic', compact('users'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $take = $request->take;
            $skip = $request->skip;
            $search = $request->search;
            $orderBy = 'created_at';
            $orderAsc = true;

            // $users = User::search($request->search);
            // $paginator = $users->paginate($take, '', $skip);
            // $paginator->load('roles');
            // $data = $paginator->getCollection();

            $data = User::orderBy($orderBy, $orderAsc ? 'ASC' : 'DESC')
            ->with(['roles' => function ($query) {
                $query->select('id', 'name');
            }])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                ->OrWhereHas('roles', function ($query2) use ($search) {
                    $query2->whereIn('name', ["{$search}"]);
                });
            })
            ->take($take)
            ->skip($skip)
            ->get();

            $countAll = User::get()->count();
            $countFilter = $data->count();

            return response()->json([
                'data' => $data,
                'count_total' => $countAll,
                'count_filter' => $countFilter,
            ]);
        }

        $can_users_delete = auth()->user()->can('users.delete');
        $can_users_edit = auth()->user()->can('users.edit');

        return view('backend.pages.users.index', [
            'can_users_delete' => $can_users_delete,
            'can_users_edit' => $can_users_edit,
        ]);
    }

    public function create()
    {
        if (auth()->user()->getRoleNames()->contains('super-admin')) {
            $roles = Role::pluck('name', 'name')->all();
        } else {
            $roles = Role::where('name', '!=', 'super-admin')->pluck('name', 'name')->all();
        }
        return view('backend.pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('accounts.users.index')->with('success', __('user.store_success'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('backend.pages.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        if (auth()->user()->getRoleNames()->contains('super-admin')) {
            $roles = Role::pluck('name', 'name')->all();
        } else {
            $roles = Role::where('name', '!=', 'super-admin')->pluck('name', 'name')->all();
        }
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('backend.pages.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('accounts.users.index')->with('success', __('user.update_success'));
    }

    public function destroy($id)
    {
        $user = User::where('id', $id);
        $user->delete();
        return response()->json([
            'status'  => true,
            'message' => __('user.destroy_success'),
        ]);
    }
}
