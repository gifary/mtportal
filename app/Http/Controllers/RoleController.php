<?php
/**
 * Created by gifary
 * Email gifary.upwork@gmail.com
 * Copyright (c) 2020.
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = [
            'name'=>'required|max:120',
            'guard_name'=>'required|max:120'
        ];

        $this->validate($request, $validate);

        $role = Role::findById($id);
        $role->update($request->only(['name','guard_name']));

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'Role successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findById($id);
        if(!empty($role)){
            $role->permissions()->delete();
            //set to null for all user
            User::where('role',$role->id)->update(['role'=>null]);

            $role->delete();

            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Role successfully deleted.');
        }else{
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Role Not found.');
        }
    }
}
