<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Role;
use Validator;

class RoleController extends Controller
{
    /*Display a listing of the resource*/
    public function index()
    {
        $all_roles = Role::all();
        //dd($all_roles);
        return view('roles.roles',['roles'=>$all_roles]);
    }


    /*Show the form for creating a new resource*/
    public function create()
    {
    }


    /*Store a newly created resource in storage*/
    public function store(Request $request)
    {
        if($request->input('id')){
            $this->validate($request, [
                'name' => 'required',
                'slug' => 'required',
            ]);
            $role = Role::findOrFail($request->input('id'));
            $role->name = $request->input('name');
            $role->slug = $request->input('slug');
            if($role->save()){
                return redirect('/role')->with('success','Role has been updated!');
            }
        }else{
        $this->validate($request, [
            'role_name' => 'required',
            'role_slug' => 'required|unique:roles,slug',
        ]);
        $role = new Role;
        $role->name = $request->input('role_name');
        $role->slug = $request->input('role_slug');
        if($role->save())
         return redirect('/role')->with('success','Role has been added!');
        }
    }


    /*Display the specified resource*/
    public function show($id)
    {
        //
    }


    /*Show the form for editing the specified resource*/
    public function edit($id)
    {
        $role = Role::findOrFail($id);
     //   dd($role);
        return view('roles.edit',['role'=>$role]);
    }


    /*Update the specified resource in storage*/
    public function update(Request $request, $id)
    {
        //
    }


    public function updateRole(Request $request)
    {
        $role = Role::findOrFail($request->input('id'));
        $role->name = $request->input('role_name');
        $role->slug = $request->input('role_slug');
        if($role->save()){
            return response ()->json ('updated');
        }
    }

    
    /*Remove the specified resource from storage*/
    public function destroy($id)
    {
        //
    }


    /* Delete Roles */
    public function deleteRole(Request $request) {
        Role::find ( $request->id )->delete ();
        return redirect('/role');
    }
}