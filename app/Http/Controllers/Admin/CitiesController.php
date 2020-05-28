<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDatatable;
use App\Http\Controllers\Controller;
use App\Model\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CityDatatable $city)
    {
        return $city->render('admin.cities.index', ['title' => trans('admin.cities')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create', ['title' => trans('admin.create_cities')]);
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
                'city_name_ar' => 'required',
                'city_name_en' => 'required',
                'country_id' => 'required|numeric',

            ]);

        City::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('cities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        
        $title = trans('admin.edit');
        return view('admin.cities.edit', compact('city', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $data = $this->validate(request(),
            [
                'city_name_ar' => 'required',
                'city_name_en' => 'required',
                'country_id' => 'required|numeric',
            ]);

        $city->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('cities'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            /*foreach (request('item') as $id) {
            $cities = City::find($id);
            $cities->delete();
            }*/
            City::destroy(request('item'));
        } else {
            $cities = City::find(request('item'));
            $cities->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('cities'));
    }

}
