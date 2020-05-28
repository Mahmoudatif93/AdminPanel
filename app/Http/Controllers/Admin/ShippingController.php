<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;
use App\Model\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDatatable $trade)
    {
        return $trade->render('admin.shipping.index', ['title' => trans('admin.shipping')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create', ['title' => trans('admin.add')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'address' => 'sometimes|nullable',
                'facebook' => 'sometimes|nullable|url',
                'twitter' => 'sometimes|nullable|url',
                'website' => 'sometimes|nullable|url',
                'mobile' => 'required|numeric',
                'user_id' => 'required|numeric',
                'lat' => 'sometimes|nullable',
                'lng' => 'sometimes|nullable',
                'icon' => 'sometimes|nullable|' . v_image(),
            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'shipping',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        Shipping::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('shipping'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    //public function edit($id)
    {
        //dd($shipping);
        //$shipping = Shipping::find($id);
        $title = trans('admin.edit');
        return view('admin.shipping.edit', compact('shipping', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Shipping $shipping)
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'address' => 'sometimes|nullable',
                'facebook' => 'sometimes|nullable|url',
                'twitter' => 'sometimes|nullable|url',
                'website' => 'sometimes|nullable|url',
                'mobile' => 'required|numeric',
                'user_id' => 'required|numeric',
                'lat' => 'sometimes|nullable',
                'lng' => 'sometimes|nullable',
                'icon' => 'sometimes|nullable|' . v_image(),
            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'shipping',
                'upload_type' => 'single',
                'delete_file' => Shipping::find($id)->icon,
            ]);
        }

        Shipping::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('shipping'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Shipping $shipping)
    public function destroy($id)
    {
        $shipping = Shipping::find($id);
        Storage::delete($shipping->icon);
        $shipping->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('shipping'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $shipping = Shipping::find($id);
                Storage::delete($shipping->icon);
                $shipping->delete();
            }
        } else {
            $shipping = Shipping::find(request('item'));
            Storage::delete($shipping->icon);
            $shipping->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('shipping'));
    }
}
