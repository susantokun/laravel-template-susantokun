<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : DownloadController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Sunday, 26th June 2022 6:08:08 am
 * | Last Modified   : Sunday, 26th June 2022 6:08:32 am
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\BaseController as BaseController;

class DownloadController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __invoke(Request $request)
    {
        $user = auth()->user();
        if ($request->permission_download) {
            if ($user->can($request->permission_download)) {
                $file_path = $request->file_path;
                if ($file_path) {
                    if (Storage::disk('public')->exists($file_path)) {
                        return $this->sendResponse( Storage::disk('public')->url($file_path), 'File berhasil diunduh!');
                    } else {
                        return $this->sendError(null, 'File tidak ditemukan!', 200);
                    }
                } else {
                    return $this->sendError(null, 'File tidak ditemukan!', 200);
                }
            } else {
                return $this->sendError(null, 'Anda tidak memiliki izin akses!', 200);
            }
        }
        return $this->sendError(null, 'Anda tidak memiliki izin akses!', 200);
    }
}
