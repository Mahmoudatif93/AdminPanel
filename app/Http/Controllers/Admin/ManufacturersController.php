<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Manufacturers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DataTables\ManuFactskDatatable;


class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManuFactskDatatable $trade)
    {
        return $trade->render('admin.manufacturers.index', ['title' => trans('admin.manufacturers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturers.create', ['title' => trans('admin.add')]);
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
                'name_ar' => 'required',
                'name_en' => 'required',
                'mobile' => 'required|numeric',
                'email' => 'required|email',
                'address' => 'sometimes|nullable',
                'facebook' => 'sometimes|nullable|url',
                'twitter' => 'sometimes|nullable|url',
                'website' => 'sometimes|nullable|url',
                'contact_name' => 'sometimes|nullable|string',
                'lat' => 'sometimes|nullable',
                'lng' => 'sometimes|nullable',
                'icon' => 'sometimes|nullable|' . v_image(),
            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'manufacturers',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        Manufacturers::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('manufacturers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Manufacturers  $manufacturers
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturers $manufacturers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Manufacturers  $manufacturers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $manufacturer = Manufacturers::find($id);
        $title = trans('admin.edit');
        return view('admin.manufacturers.edit', compact('manufacturer', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Manufacturers  $manufacturers
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Manufacturers $manufacturers)
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'mobile' => 'required|numeric',
                'email' => 'required|email',
                'address' => 'sometimes|nullable',
                'facebook' => 'sometimes|nullable|url',
                'twitter' => 'sometimes|nullable|url',
                'website' => 'sometimes|nullable|url',
                'contact_name' => 'sometimes|nullable|string',
                'lat' => 'sometimes|nullable',
                'lng' => 'sometimes|nullable',
                'icon' => 'sometimes|nullable|' . v_image(),
            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'manufacturers',
                'upload_type' => 'single',
                'delete_file' => Manufacturers::find($id)->icon,
            ]);
        }

        Manufacturers::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('manufacturers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Manufacturers  $manufacturers
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Manufacturers $manufacturers)
    public function destroy($id)
    {
        $manufacturers = Manufacturers::find($id);
        Storage::delete($manufacturers->icon);
        $manufacturers->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('manufacturers'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $manufacturers = Manufacturers::find($id);
                Storage::delete($manufacturers->icon);
                $manufacturers->delete();
            }
        } else {
            $manufacturers = Manufacturers::find(request('item'));
            Storage::delete($manufacturers->icon);
            $manufacturers->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('manufacturers'));
    }

}
