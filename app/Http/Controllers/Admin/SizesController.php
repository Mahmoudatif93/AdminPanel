<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SizesDatatable;
use App\Http\Controllers\Controller;
use App\Model\Size;
use Illuminate\Http\Request;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizesDatatable $size)
    {
        return $size->render('admin.sizes.index', ['title' => __('admin.sizes')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create', ['title' => trans('admin.add')]);
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
        $date = $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'department_id' => 'required|numeric',
            'is_public' => 'required|in:yes,no',
        ]);

        Size::create($date);
        message_view('success', __('admin.added_record'));
        return redirect(aurl('sizes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //dd($size);
        //$size  = Size::find($id);
        $title = trans('admin.edit');
        return view('admin.sizes.edit', compact('size', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $date = $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
            'department_id' => 'required|numeric',
            'is_public' => 'required|in:yes,no',
        ]);

        //Size::where('id', $id)->update($data);
        $size->update($date);
        message_view('success', __('admin.updated_record'));
        return redirect(aurl('sizes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        //$size = Size::find($id);
        $size->delete();
        message_view('success', __('admin.deleted_record'));
        return redirect(aurl('sizes'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $item = Size::find($id);
                $item->delete();
            }
        } else {
            $item = Size::find(request('item'));
            $item->delete();
        }

        message_view('success', trans('admin.deleted_record'));
        return redirect(aurl('sizes'));
    }
}
