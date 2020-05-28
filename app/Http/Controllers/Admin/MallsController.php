<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MallsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Mall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallsDatatable $mall)
    {
        return $mall->render('admin.malls.index', ['title' => trans('admin.malls')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.malls.create', ['title' => trans('admin.add')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $this->validate(request(),
            [
                'name_ar'      => 'required',
                'name_en'      => 'required',
                'mobile'       => 'required|numeric',
                'email'        => 'required|email',
                'country_id'   => 'required|numeric',
                'address'      => 'sometimes|nullable',
                'facebook'     => 'sometimes|nullable|url',
                'twitter'      => 'sometimes|nullable|url',
                'website'      => 'sometimes|nullable|url',
                'contact_name' => 'sometimes|nullable|string',
                'lat'          => 'sometimes|nullable',
                'lng'          => 'sometimes|nullable',
                'icon'         => 'sometimes|nullable|' . v_image(),
            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'malls',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        Mall::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('malls'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function show(Mall $mall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    //public function edit(Mall $mall)
    public function edit($id)
    {
        $mall = Mall::find($id);
        $title = trans('admin.edit');
        return view('admin.malls.edit', compact('mall', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Mall $mall)
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'name_ar'      => 'required',
                'name_en'      => 'required',
                'mobile'       => 'required|numeric',
                'email'        => 'required|email',
                'country_id'   => 'required|numeric',
                'address'      => 'sometimes|nullable',
                'facebook'     => 'sometimes|nullable|url',
                'twitter'      => 'sometimes|nullable|url',
                'website'      => 'sometimes|nullable|url',
                'contact_name' => 'sometimes|nullable|string',
                'lat'          => 'sometimes|nullable',
                'lng'          => 'sometimes|nullable',
                'icon'         => 'sometimes|nullable|' . v_image(),
            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'malls',
                'upload_type' => 'single',
                'delete_file' => Mall::find($id)->icon,
            ]);
        }

        Mall::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('malls'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Mall $mall)
    public function destroy($id)
    {
        $malls = Mall::find($id);
        Storage::delete($malls->icon);
        $malls->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('malls'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $malls = Mall::find($id);
                Storage::delete($malls->icon);
                $malls->delete();
            }
        } else {
            $malls = Mall::find(request('item'));
            Storage::delete($malls->icon);
            $malls->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('malls'));
    }
}
