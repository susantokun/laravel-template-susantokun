<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : MenuController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Wednesday, 15th June 2022 3:07:29 pm
 * | Last Modified   : Sunday, 19th June 2022 5:54:21 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class MenuController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:menus view', ['only' => ['index', 'show']]);
        $this->middleware('permission:menus create', ['only' => ['create', 'store']]);
        $this->middleware('permission:menus edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menus delete', ['only' => ['destroy']]);
    }

    public function menuSelect(Request $request)
    {
        $role = $request->role;

        if ($role == NULL || $role == "") {
            $parent = Menu::pluck('title', 'id')->all();
        } else {
            $parent = Menu::where('role_id', $role)->get(['title', 'id']);
        }

        $menuInduk = [
            0 => [
                'id' => 0,
                'title' => 'Menu Induk'
            ]
        ];

        $parents = [];
        foreach ($parent as $key => $value) {
            $parents[$key]['id'] = $value->id;
            $parents[$key]['title'] = $value->title;
        }
        $parents2 = array_merge($menuInduk, $parents);

        return $this->sendResponse($parents2, __('menu.menus') .' '. __('label.get_data_success'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Menu::with(['parent', 'role'])->orderBy('id', 'desc')->get();

        return $this->sendResponse($data, __('menu.menus') .' '. __('label.get_data_success'));
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
