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
        return view('backend.pages.user.index', [
            'users' => $users
        ]);
    }

    public function basic(Request $request)
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('backend.pages.user.userBasic', [
            'users' => $users
        ]);
    }
}
