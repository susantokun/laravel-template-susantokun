<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : FileManagerController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Sunday, 26th June 2022 3:02:29 pm
 * | Last Modified   : Sunday, 26th June 2022 6:23:24 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers;

use App\Models\FileManager;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:file managers view', ['only' => ['index', 'show']]);
        $this->middleware('permission:file managers create', ['only' => ['create', 'store']]);
        $this->middleware('permission:file managers edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:file managers delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $can_file_managers_delete = auth()->user()->can('file managers delete');
        $can_file_managers_edit = auth()->user()->can('file managers edit');

        return view('backend.pages.file-managers.index', [
            'can_file_managers_delete' => $can_file_managers_delete,
            'can_file_managers_edit' => $can_file_managers_edit,
        ]);
    }

    public function create()
    {
        return view('backend.pages.file-managers.create');
    }

    public function store(Request $request)
    {
        $request['name'] = str()->slug($request->name, '-');
        $request['code'] = str()->slug($request->code, '_');

        $this->validate($request, [
            'code' => 'required|string|unique:file_managers,code',
            'name' => 'required|string|unique:file_managers,name',
            'path' => 'required|mimes:xlsx',
        ]);

        $input = $request->all();
        if ($request->hasfile('path')) {
            $file_folder = 'documents/excel';
            $file_path = $request->file('path');
            $file_name = str()->slug($request->name) . "." . $file_path->getClientOriginalExtension();
            $file_path_name = $file_folder . '/' . $file_name;
            Storage::disk('public')->putFileAs($file_folder, $file_path, $file_name);
            $input['path'] = $file_path_name;
        } else {
            $input = Arr::except($input, array('path'));
        }

        FileManager::create($input);

        return redirect()->route('settings.file-managers.index')->with('success', __('fileManager.store_success'));
    }

    public function show($id)
    {
        $fileManager = FileManager::find($id);

        return view('backend.pages.file-managers.show', compact('fileManager'));
    }

    public function edit($id)
    {
        $fileManager = FileManager::find($id);

        return view('backend.pages.file-managers.edit', compact('fileManager'));
    }

    public function update(Request $request, $id)
    {
        $request['name'] = str()->slug($request->name, '-');
        $request['code'] = str()->slug($request->code, '_');

        $this->validate($request, [
            'code' => 'required|string|unique:file_managers,code,' .$id,
            'name' => 'required|string|unique:file_managers,name,' .$id,
            'path' => 'required|mimes:xlsx',
        ]);

        $fileManager = FileManager::findOrFail($id);
        $input = $request->all();
        if ($request->hasfile('path')) {
            $file_folder = 'documents/excel';
            $file_path = $request->file('path');
            $file_name = str()->slug($request->name) . "." . $file_path->getClientOriginalExtension();
            $file_path_name = $file_folder . '/' . $file_name;

            if ($fileManager->path != ''  && $fileManager->path != null) {
                Storage::disk('public')->delete($fileManager->path);
            }

            Storage::disk('public')->putFileAs($file_folder, $file_path, $file_name);
            $input['path'] = $file_path_name;
        } else {
            $input = Arr::except($input, array('path'));
        }

        $fileManager->update($input);

        return redirect()->route('settings.file-managers.index')->with('success', __('fileManager.update_success'));
    }

    public function destroy($id)
    {
        $fileManager = FileManager::findOrFail($id);

        if ($fileManager->path) {
            if (Storage::disk('public')->exists($fileManager->path)) {
                Storage::disk('public')->delete($fileManager->path);
            }
        }

        $fileManager->delete();

        return response()->json([
            'status'  => true,
            'message' => __('fileManager.destroy_success'),
        ]);
    }
}
