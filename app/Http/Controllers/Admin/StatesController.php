<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\State;
use Illuminate\Http\Request;
use App\Model\City;
use Form;
use App\DataTables\StateDatatable;


class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateDatatable $state)
    {
        return $state->render('admin.states.index', ['title' => trans('admin.states')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()) {
            if (request()->has('country_id')) {
                //Country::where('id', request('country_id'))->first()->cities//can use this if you  use hasmeny
                $select = request()->has('select') ? request('select') : '';
                return Form::select('city_id', City::where('country_id', request('country_id'))->pluck('city_name_' . session('lang'), 'id'), $select, ['class' => 'form-control', 'placeholder' =>__('admin.choselist')]);
            }
        }
        return view('admin.states.create', ['title' => trans('admin.create_states')]);
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
                'state_name_ar' => 'required',
                'state_name_en' => 'required',
                'country_id' => 'required|numeric',
                'city_id' => 'required|numeric',
            ]);

        State::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('states'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $title = trans('admin.edit');
        return view('admin.states.edit', compact('state', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $data = $this->validate(request(),
            [
                'state_name_ar' => 'required',
                'state_name_en' => 'required',
                'country_id' => 'required|numeric',
                'city_id' => 'required|numeric',
            ]);

        $state->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('states'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {

            State::destroy(request('item'));
        } else {
            $states = State::find(request('item'));
            $states->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('states'));
    }
}
