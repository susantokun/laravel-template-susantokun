<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->name) {
            $file = 'documents/excel/'.$request->name;
            if (Storage::disk('public')->exists($file)) {
                return Storage::disk('public')->download($file);
            }
            abort(404);
        }
        abort(404);
    }
}
