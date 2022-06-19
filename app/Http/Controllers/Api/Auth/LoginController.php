<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : LoginController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Sunday, 19th June 2022 4:18:34 pm
 * | Last Modified   : Sunday, 19th June 2022 5:06:58 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->with('roles')->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Email yang diberikan tidak ditemukan.'],
            ]);
        }

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Kata sandi yang diberikan salah.'],
            ]);
        }

        if (!$user->status) {
            throw ValidationException::withMessages([
                'status' => ['Status akun nonaktif, silakan hubungi pihak terkait.'],
            ]);
        }

        $access_token = $user->createToken($request->device_name)->plainTextToken;

        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);

        $response = [
            'status' => true,
            'message' => 'Selamat datang, '.$user->first_name.'.',
            'data' => $user,
            'access_token' => $access_token,
            'token_type' => 'Bearer'
        ];

        return response($response, 201);
    }
}
