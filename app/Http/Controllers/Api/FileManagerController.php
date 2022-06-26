<?php

namespace App\Http\Controllers\Api;

use App\Models\FileManager;
use App\Http\Controllers\Api\BaseController as BaseController;

class FileManagerController extends BaseController
{
    public function index()
    {
        $data = FileManager::orderBy('id', 'desc')->get();

        return $this->sendResponse($data, __('fileManager.fileManagers') .' '. __('label.get_data_success'));
    }
}
