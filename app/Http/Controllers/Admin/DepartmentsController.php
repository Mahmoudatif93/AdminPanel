<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(load_dep());
        /*$d = Department::find(2)->department;
        //$d = Department::find(1)->departments;
        //$d = Department::where('id',1)->first()->departments;
        dd($d->id);*/
        return view('admin.departments.index', ['title' => trans('admin.departments')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create', ['title' => trans('admin.add')]);
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
        //dd( request()->file('icon')->store('departments'));

        $data = $this->validate(request(),
            [
                'dep_name_ar' => 'required',
                'dep_name_en' => 'required',
                'department_id' => 'sometimes|nullable|numeric',
                'icon' => 'sometimes|nullable|' . v_image(),
                'description' => 'sometimes|nullable',
                'keyword' => 'sometimes|nullable',

            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'departments',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        Department::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('departments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //$department = Department::find($id);
        $title = trans('admin.edit');
        return view('admin.departments.edit', compact('department', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        
        $data = $this->validate(request(),
            [
                'dep_name_ar' => 'required',
                'dep_name_en' => 'required',
                'department_id' => 'sometimes|nullable|numeric',
                'icon' => 'sometimes|nullable|' . v_image(),
                'description' => 'sometimes|nullable',
                'keyword' => 'sometimes|nullable',
            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file' => 'icon',
                'path' => 'departments',
                'upload_type' => 'single',
                'delete_file' => $department->icon,
            ]);
        }
        //dd($data);
        $department->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('departments'));
    }

    public static function delete_parent($id) {
		$department_parent = Department::where('department_id', $id)->get();
		foreach ($department_parent as $sub) {
			self::delete_parent($sub->id);
			if (!empty($sub->icon)) {
				Storage::has($sub->icon)?Storage::delete($sub->icon):'';
			}
			$subdepartment = Department::find($sub->id);
			if (!empty($subdepartment)) {
				$subdepartment->delete();
			}
		}
		$dep = Department::find($id);

		if (!empty($dep->icon)) {
			Storage::has($dep->icon)?Storage::delete($dep->icon):'';
		}
		$dep->delete();
	}
	public function destroy($id) {
		self::delete_parent($id);
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('departments'));
	}
}
