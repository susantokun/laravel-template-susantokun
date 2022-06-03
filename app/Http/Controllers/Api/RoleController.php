<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::with('permissions')->orderBy('id', 'desc')->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
