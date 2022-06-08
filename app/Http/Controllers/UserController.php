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
        // $users = User::where('name', 'like', "%{$request->search}%")->get();

        // $users = User::search($request->search)->get();

        // return $users;
        if ($request->ajax()) {
            $take = $request->take;
            $skip = $request->skip;

            $page = (int)$skip / (int)$take + (int)$take;
            $users = User::search($request->search);
            $paginator = $users->paginate($take, '', $skip);
            $paginator->load('roles');
            $data = $paginator->getCollection();

            // $data = User::search($request->search);
            // ->take($request->limit)
            // ->with('roles')
            // ->skip($request->skip)
            // ->with(['roles' => function ($q) {
            //     $q->with('permissions');
            // }])
            // ->get();

            $countAll = User::get()->count();
            $countFilter = User::search($request->search)->get()->count();

            return response()->json([
                'data' => $data,
                'count_total' => $countAll,
                'count_filter' => $countFilter,
            ]);
        }

        return view('backend.pages.users.index');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
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

        return redirect()->route('accounts.users.index')->with('success', 'User Created Successfully!');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('backend.pages.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::pluck('name', 'name')->all();
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

        return redirect()->route('accounts.users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id);
        $user->delete();
        return response()->json([
            'status'  => true,
            'message' => 'User Deleted Successfully!',
        ]);
    }
}
