<?php

namespace App\Http\Controllers;

use Image;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users view', ['only' => ['index', 'show']]);
        $this->middleware('permission:users create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users delete', ['only' => ['destroy']]);
    }

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
            $orderAsc = false;

            // $users = User::search($request->search);
            // $paginator = $users->paginate($take, '', $skip);
            // $paginator->load('roles');
            // $data = $paginator->getCollection();

            $auth_can_users_view_superadmin = auth()->user()->can('users view superadmin');
            $superadmin = auth()->user()->getRoleNames()->contains('superadmin');

            $data = User::orderBy($orderBy, $orderAsc ? 'ASC' : 'DESC')
            ->with(['roles' => function ($query) {
                $query->select('id', 'name');
            }])
            ->take($take)
            ->skip($skip);

            if ($superadmin || $auth_can_users_view_superadmin) {
                $data->when($search, function ($query) use ($search) {
                    $query->where('username', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('roles', function ($query2) use ($search) {
                        $query2->whereIn('name', ["{$search}"]);
                    });
                });
            } else {
                $data->whereHas('roles', function($q) {
                    $q->whereNotIn('name', ['superadmin']);
                })
                ->when($search, function ($query) use ($search) {
                    $query->where('username', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->whereHas('roles', function ($query2) use ($search) {
                        $query2->whereNotIn('name', ['superadmin'])->whereIn('name', ["{$search}"]);
                    });
                });
            }

            $countAll = User::get()->count();
            $countFilter = $data->get()->count();

            return response()->json([
                'data' => $data->get(),
                'count_total' => $countAll,
                'count_filter' => $countFilter,
            ]);
        }

        $can_users_delete = auth()->user()->can('users delete');
        $can_users_edit = auth()->user()->can('users edit');

        return view('backend.pages.users.index', [
            'can_users_delete' => $can_users_delete,
            'can_users_edit' => $can_users_edit,
        ]);
    }

    public function create()
    {
        if (auth()->user()->getRoleNames()->contains('superadmin')) {
            $roles = Role::pluck('name', 'name')->all();
        } else {
            $roles = Role::where('name', '!=', 'superadmin')->pluck('name', 'name')->all();
        }
        return view('backend.pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'first_name' => 'required',
            'last_name' => '',
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'same:confirm-password',
            'phone' => 'required',
            'status' => 'required',
            'roles' => 'required',
        ]);

        $input = $request->all();
        if ($request->hasfile('image_file')) {
            $request->validate([
                'image_name'  => 'required',
                'image_file'  => 'required|image|mimes:jpeg,png,jpg|max:3072',
            ]);

            $image_folder = 'images/profiles';
            $image_file = $request->file('image_file');
            $image_file_name = $request->username.".".$image_file->getClientOriginalExtension();
            $image_file_path = $image_folder.'/'.$image_file_name;
            $image_file_image = Image::make($image_file);
            $image_file_image->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('public')->put($image_file_path, (string) $image_file_image->encode());
            $input['image_file'] = $image_file_path;
        } else {
            $input = Arr::except($input, array('image_file'));
        }

        $input['created_by'] = auth()->user()->id;
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('accounts.users.index')->with('success', __('user.store_success'));
    }

    public function show($id)
    {
        $auth_can_users_view_superadmin = auth()->user()->can('users view superadmin');
        $user_can_users_view_superadmin = User::find($id)->can('users view superadmin');
        $superadmin = auth()->user()->getRoleNames()->contains('superadmin');
        $admin = auth()->user()->getRoleNames()->contains('admin');

        if (($user_can_users_view_superadmin && $superadmin) || $auth_can_users_view_superadmin) {
            $user = User::find($id);
        } else if (!$user_can_users_view_superadmin && ($admin || $superadmin) || $auth_can_users_view_superadmin) {
            $user = User::find($id);
        } else {
            abort(401);
        }

        return view('backend.pages.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        if (auth()->user()->getRoleNames()->contains('superadmin')) {
            $roles = Role::pluck('name', 'name')->all();
        } else {
            $roles = Role::where('name', '!=', 'superadmin')->pluck('name', 'name')->all();
        }
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('backend.pages.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,' . $id,
            'first_name' => 'required',
            'last_name' => '',
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'phone' => 'required',
            'status' => 'required',
            'roles' => 'required',
        ]);

        $user = User::findOrFail($id);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if ($request->hasfile('image_file')) {
            $request->validate([
                'image_name'  => 'required',
                'image_file'  => 'required|image|mimes:jpeg,png,jpg|max:3072',
            ]);

            $image_folder = 'images/profiles';
            $image_file = $request->file('image_file');
            $image_file_name = $request->username.".".$image_file->getClientOriginalExtension();
            $image_file_path = $image_folder.'/'.$image_file_name;
            $image_file_image = Image::make($image_file);
            $image_file_image->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            });

            if($user->image_file != ''  && $user->image_file != null){
                Storage::disk('public')->delete($user->image_file);
            }

            Storage::disk('public')->put($image_file_path, (string) $image_file_image->encode());
            $input['image_file'] = $image_file_path;
        } else {
            $input = Arr::except($input, array('image_file'));
        }

        $input['updated_by'] = auth()->user()->id;

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('accounts.users.index')->with('success', __('user.update_success'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (Storage::disk('public')->exists($user->image_file)) {
            Storage::disk('public')->delete($user->image_file);
        }

        $user->delete();
        return response()->json([
            'status'  => true,
            'message' => __('user.destroy_success'),
        ]);
    }
}
