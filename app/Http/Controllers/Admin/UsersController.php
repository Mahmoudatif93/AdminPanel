<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDatatable;

use App\User;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDatatable $users)
    {
        return $users->render('admin.users.index', ['title' => trans('admin.users')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['title' => trans('admin.create')]);
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
                'name'     => 'required',
                'level'     => 'required|in:user,vendor,company',
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
            ],
            [],
            [
                'name'     => trans('admin.name'),
                'level'    => trans('admin.level'),
                'email'    => trans('admin.email'),
                'password' => trans('admin.password'),
                'password_confirmation' => trans('admin.password_confirmation'),
            ]
        );
        $data['password'] = bcrypt(request('password'));
        User::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['title' => trans('admin.update'), 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validate(
            request(),
            [
                'name'     => 'required',
                'level'     => 'required|in:user,vendor,company',
                'email'    => 'required|email|unique:users,email,' . $user->id,
                'password' => 'sometimes|nullable|min:6|confirmed',
                'password_confirmation' => 'sometimes|nullable',
            ],
            [],
            [
                'name'     => trans('admin.name'),
                'level'    => trans('admin.level'),
                'email'    => trans('admin.email'),
                'password' => trans('admin.password'),
                'password_confirmation' => trans('admin.password_confirmation'),
            ]
        );
        //unset($data['password_confirmation']);
        if (request()->has('password')) {
            $data['password'] = bcrypt(request('password'));
        }
        //Admin::where('id',$id)->update($data);
        $user->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('users'));
    }

    public function multi_delete()
    {
        if (is_array(request('item'))) {
            User::destroy(request('item'));
        } else {
            User::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('users'));
    }
}
