<?php

namespace App\Http\Controllers;

use App\Models\Configuration;

class ConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:configurations.*', ['only' => ['index', 'show']]);
        $this->middleware('permission:configurations.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:configurations.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:configurations.delete', ['only' => ['destroy']]);
    }

    public function general()
    {
        $permissions = auth()->user()->getPermissionsViaRoles();
        $can_publish = auth()->user()->hasPermissionTo('configurations.publish');
        $can_unpublish = auth()->user()->hasPermissionTo('configurations.unpublish');
        $role = auth()->user()->getRoleNames()[0];

        $data = Configuration::where('status', 1)->first([
            'id',
            'code',
            'title',
            'title_short',
            'desc',
            'slogan',
            'author',
            'favicon_name',
            'favicon_file',
            'logo_name',
            'logo_file',
            'keywords',
            'metatext',
            'place_of_birth',
            'date_of_birth',
            'api_key',
            'status',
        ]);

        return view('backend.pages.configurations.general', [
            'data' => $data,
            'role' => $role
        ]);
    }

    public function about()
    {
        $data = Configuration::where('status', 1)->first([
            'id',
            'about',
        ]);

        return view('backend.pages.configurations.about', [
            'data' => $data,
        ]);
    }
    public function contact()
    {
        $data = Configuration::where('status', 1)->first([
            'id',
            'address',
            'email',
            'phone',
            'map_src',
            'map_link',
        ]);

        return view('backend.pages.configurations.contact', [
            'data' => $data,
        ]);
    }
    public function privacyPolicy()
    {
        $data = Configuration::where('status', 1)->first([
            'id',
            'privacy_policy',
        ]);

        return view('backend.pages.configurations.privacy-policy', [
            'data' => $data,
        ]);
    }
    public function termAndCondition()
    {
        $data = Configuration::where('status', 1)->first([
            'id',
            'term_and_condition',
        ]);

        return view('backend.pages.configurations.term-and-condition', [
            'data' => $data,
        ]);

    }
}
