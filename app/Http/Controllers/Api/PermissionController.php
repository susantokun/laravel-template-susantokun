<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $data = Permission::orderBy('id', 'desc')->get();

        return response()->json([
            'data' => $data,
        ]);
    }
}
