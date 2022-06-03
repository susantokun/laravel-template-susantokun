<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('backend.pages.users.index', [
            'users' => $users
        ]);
    }

    public function basic(Request $request)
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('backend.pages.users.userBasic', [
            'users' => $users
        ]);
    }

    public function userRolePermission()
    {
        return view('backend.pages.users.usersRolePermission');
    }
}
