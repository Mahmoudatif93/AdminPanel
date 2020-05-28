<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WeightsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Weight;
use Illuminate\Http\Request;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WeightsDatatable $trade)
    {
        return $trade->render('admin.weights.index', ['title' => trans('admin.weights')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weights.create', ['title' => trans('admin.add')]);
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

            ]);

        Weight::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('weights'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function show(Weight $weight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function edit(Weight $weight)
    {
        $title = trans('admin.edit');
        return view('admin.weights.edit', compact('weight', 'title'));}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weight $weight)
    {
        $date = $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        //Size::where('id', $id)->update($data);
        $weight->update($date);
        message_view('success', __('admin.updated_record'));
        return redirect(aurl('weights'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weight $weight)
    {
        $weight->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('weights'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $malls = Weight::find($id);
                $malls->delete();
            }
        } else {
            $malls = Weight::find(request('item'));
            $malls->delete();
        }
        message_view('success', trans('admin.deleted_record'));
        return redirect(aurl('weights'));
    }

}
