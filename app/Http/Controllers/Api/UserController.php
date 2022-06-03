<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with('roles')->orderBy('id', 'desc')->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function indexServerSide($limit = 0, $skip = 0)
    {
        $data = User::take($limit)
        ->with('roles')
        ->skip($skip)
        ->with(['roles' => function($q) {
            $q->with('permissions');
        }])
        ->orderBy('id', 'desc')->get();

        $count = User::get()->count();

        return response()->json([
            'data' => $data,
            'total' => $count,
        ]);

        // $pagination  = 5;
        // $users    = User::when($request->keyword, function ($query) use ($request) {
        //     $query
        // ->where('name', 'like', "%{$request->keyword}%")
        // ->orWhere('email', 'like', "%{$request->keyword}%");
        // })->orderBy('created_at', 'desc')->paginate($pagination);

        // $users->appends($request->only('keyword'));

        // return view('backend.pages.user.index', [
        //     'title'    => 'Users',
        //     'users' => $users,
        // ])->with('i', ($request->input('page', 1) - 1) * $pagination);
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
