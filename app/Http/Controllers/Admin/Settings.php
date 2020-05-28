<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Http\Request;
use Storage;
use Up;

class Settings extends Controller
{
    public function setting()
    {
        return view('admin.settings', ['title' => trans('admin.settings')]);
    }

    public function setting_save()
    {

        $data = request()->except(['_token', '_method']);
        //
        $data = $this->validate(
            request(),
            [
                'logo' => v_image(),
                'icon' => v_image(),
                'sitename_ar' => 'required',
                'sitename_en' => 'required',
                'email' => 'required',
                'description' => 'required',
                'keywords' => 'required',
                'status' => 'required',
                'message_maintenance' => 'required',
            ],
            [],
            [
                'logo' => trans('admin.logo'),
                'icon' => trans('admin.icon'),
            ]
        );

        //

        if (request()->hasFile('logo')) {
            $data['logo'] = Up::upload([
                'file' => 'logo',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->logo,
            ]);
        }

        if (request()->hasFile('icon')) {
            /*(!empty(setting()->icon)) ? Storage::delete(setting()->icon) : '';
            $data['icon'] = request()->file('icon')->store('settings');
            //dd($data['icon']);*/
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->icon,
            ]);
        }
        //dd($request_data);
        Setting::orderBy('id', 'desc')->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('settings'));
    }
}
