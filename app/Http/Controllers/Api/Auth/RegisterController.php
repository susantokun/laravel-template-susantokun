<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : RegisterController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Sunday, 19th June 2022 4:25:01 pm
 * | Last Modified   : Sunday, 19th June 2022 5:06:39 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string|min:4|unique:users,username',
            'first_name' => 'required|string',
            'last_name' => 'string',
            'full_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string|min:10|max:13',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'username' => str()->lower($fields['username']),
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'full_name' => $fields['full_name'],
            'email' => str()->lower($fields['email']),
            'phone' => $fields['phone'],
            'password' => bcrypt($fields['password']),
        ]);

        $user->assignRole('member');

        $access_token = $user->createToken($request->device_name)->plainTextToken;

        $response = [
            'status' => true,
            'message' => 'Yey! berhasil daftar, '.$user->first_name.'.',
            'data' => $user,
            'access_token' => $access_token,
            'token_type' => 'Bearer'
        ];

        return response($response, 201);
    }
}
