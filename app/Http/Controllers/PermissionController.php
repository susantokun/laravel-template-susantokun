<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::orderBy('id', 'desc')->get();

            return response()->json([
                'data' => $data,
            ]);
        }

        return view('backend.pages.permissions.index');
    }
}
