<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : LogoutController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Sunday, 19th June 2022 4:27:56 pm
 * | Last Modified   : Sunday, 19th June 2022 5:06:49 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        // Revoke all tokens...
        auth()->user()->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        // $request->user()->currentAccessToken()->delete();

        // Revoke a specific token...
        // $user->tokens()->where('id', $tokenId)->delete();

        $response = [
            'status' => true,
            'message' => 'Met ketemu lagi, '.auth()->user()->first_name.'.',
        ];

        return response($response, 201);
    }
}
