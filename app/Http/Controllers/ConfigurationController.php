<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : ConfigurationController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Friday, 3rd June 2022 1:29:42 pm
 * | Last Modified   : Sunday, 19th June 2022 5:54:47 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers;

use Image;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\Storage;

class ConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:configurations view', ['only' => ['index', 'show']]);
        $this->middleware('permission:configurations create', ['only' => ['create', 'store']]);
        $this->middleware('permission:configurations edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:configurations delete', ['only' => ['destroy']]);
    }

    public function general()
    {
        $data = Configuration::where('code', env('APP_CODE'))->first();

        return view('backend.pages.configurations.general', compact('data'));
    }

    public function generalUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'title_short' => 'required',
            'desc' => 'required',
            'slogan' => 'required',
            'author' => 'required',
            'keywords' => 'required',
            'metatext' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'status' => 'required',
        ]);

        $configuration = Configuration::where('id', $id)->first();
        $input = $request->all();

        if ($request->hasfile('favicon_file')) {
            $request->validate([
                'favicon_name'  => 'required',
                'favicon_file'  => 'required|image|mimes:jpeg,png,jpg|max:3072',
            ]);

            $favicon_folder = 'images/favicons';
            $favicon_file = $request->file('favicon_file');
            $favicon_file_name = str()->slug($configuration->code)."-favicon.".$favicon_file->getClientOriginalExtension();
            $favicon_file_path = $favicon_folder.'/'.$favicon_file_name;
            $favicon_file_favicon = Image::make($favicon_file);
            $favicon_file_favicon->resize(32, 32, function ($constraint) {
                $constraint->aspectRatio();
            });

            if($configuration->favicon_file != ''  && $configuration->favicon_file != null){
                Storage::disk('public')->delete($configuration->favicon_file);
            }

            Storage::disk('public')->put($favicon_file_path, (string) $favicon_file_favicon->encode());
            $input['favicon_file'] = $favicon_file_path;
        } else {
            $input = Arr::except($input, array('favicon_file'));
        }

        if ($request->hasfile('logo_file')) {
            $request->validate([
                'logo_name'  => 'required',
                'logo_file'  => 'required|image|mimes:jpeg,png,jpg|max:3072',
            ]);

            $logo_folder = 'images/logos';
            $logo_file = $request->file('logo_file');
            $logo_file_name = str()->slug($configuration->code)."-logo.".$logo_file->getClientOriginalExtension();
            $logo_file_path = $logo_folder.'/'.$logo_file_name;
            $logo_file_logo = Image::make($logo_file);
            $logo_file_logo->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            });

            if($configuration->logo_file != ''  && $configuration->logo_file != null){
                Storage::disk('public')->delete($configuration->logo_file);
            }

            Storage::disk('public')->put($logo_file_path, (string) $logo_file_logo->encode());
            $input['logo_file'] = $logo_file_path;
        } else {
            $input = Arr::except($input, array('logo_file'));
        }

        $input['updated_by'] = auth()->user()->id;

        $configuration->update($input);

        return redirect()->route('settings.configurations.general')->with('success', __('configuration.update_general_success'));
    }

    public function about()
    {
        $data = Configuration::where('code', env('APP_CODE'))->first(['id', 'about']);

        return view('backend.pages.configurations.about', compact('data'));
    }

    public function aboutUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'about' => 'required',
        ]);

        $configuration = Configuration::where('id', $id)->first();
        $input = $request->all();

        $input['updated_by'] = auth()->user()->id;

        $configuration->update($input);

        return redirect()->route('settings.configurations.about')->with('success', __('configuration.update_about_success'));
    }

    public function contact()
    {
        $data = Configuration::where('code', env('APP_CODE'))->first([
            'id',
            'address',
            'email',
            'phone',
            'map_src',
            'map_link',
        ]);

        return view('backend.pages.configurations.contact', compact('data'));
    }

    public function contactUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'map_src' => 'required',
            'map_link' => 'required',
        ]);

        $configuration = Configuration::where('id', $id)->first();
        $input = $request->all();

        $input['updated_by'] = auth()->user()->id;

        $configuration->update($input);

        return redirect()->route('settings.configurations.contact')->with('success', __('configuration.update_contact_success'));
    }

    public function privacyPolicy()
    {
        $data = Configuration::where('code', env('APP_CODE'))->first(['id', 'privacy_policy']);

        return view('backend.pages.configurations.privacy-policy', compact('data'));
    }

    public function privacyPolicyUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'privacy_policy' => 'required',
        ]);

        $configuration = Configuration::where('id', $id)->first();
        $input = $request->all();

        $input['updated_by'] = auth()->user()->id;

        $configuration->update($input);

        return redirect()->route('settings.configurations.privacyPolicy')->with('success', __('configuration.update_privacyPolicy_success'));
    }

    public function termAndCondition()
    {
        $data = Configuration::where('code', env('APP_CODE'))->first(['id', 'term_and_condition']);

        return view('backend.pages.configurations.term-and-condition', compact('data'));
    }

    public function termAndConditionUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'term_and_condition' => 'required',
        ]);

        $configuration = Configuration::where('id', $id)->first();
        $input = $request->all();

        $input['updated_by'] = auth()->user()->id;

        $configuration->update($input);

        return redirect()->route('settings.configurations.termAndCondition')->with('success', __('configuration.update_termAndCondition_success'));
    }
}
