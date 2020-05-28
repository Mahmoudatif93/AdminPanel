<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TradeMark;
use Illuminate\Http\Request;
use App\DataTables\TradeMarkDatatable;
use Illuminate\Support\Facades\Storage;

class TradeMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarkDatatable $tradeMark)
    {
        return $tradeMark->render('admin.trademarks.index', ['title' => trans('admin.trademarks')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trademarks.create', ['title' => trans('admin.create_trademarks')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(
            request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'logo' => 'sometimes|nullable|' . v_image(),
            ]
        );
        if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        TradeMark::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('trademarks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\TradeMark  $tradeMark
     * @return \Illuminate\Http\Response
     */
    public function show(TradeMark $tradeMark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\TradeMark  $tradeMark
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tradeMark  = TradeMark::find($id);
        //dd($tradeMark);
        $title = trans('admin.edit');
        return view('admin.trademarks.edit', compact('tradeMark', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\TradeMark  $tradeMark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tradeMark  = TradeMark::find($id);

        $data = $this->validate(request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'logo' => 'sometimes|nullable|' . v_image(),
            ]);

        if (request()->hasFile('logo')) {
            $data['logo'] = up()->upload([
                'file' => 'logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => $tradeMark->logo,
            ]);
        }

        $tradeMark->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('trademarks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\TradeMark  $tradeMark
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tradeMark  = TradeMark::find($id);
        Storage::delete($tradeMark->logo);
        $tradeMark->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('trademarks'));

    }
    public function multi_delete()
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $tradeMark = TradeMark::find($id);
                Storage::delete($tradeMark->logo);
                $tradeMark->delete();
            }
        } else {
            $tradeMark = TradeMark::find(request('item'));
            Storage::delete($tradeMark->logo);
            $tradeMark->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('trademarks'));
    }
}
