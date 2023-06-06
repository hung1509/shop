<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=DB::table('roles');
        if($request->keysearch){
            $query->where('name', 'like' ,'%'.$request->keysearch.'%')
            ->orwhere('id', 'like' ,'%'.$request->keysearch.'%');
        }
        $data=$query->paginate(10)->appends(['keysearch'=>$request->keysearch]);
        return view('admin.role.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission= Permission::query()->where('parent_id', '=', 0)->get();   
        return view('admin.role.create', ['permission'=>$permission]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ])->permissions()->attach($request->permission_id);
        return redirect()->route('admin.role.index');
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
        $data = Role::find($id);
        $permission = Permission::query()->where('parent_id', '=', 0)->get(); 
        $permissionChecked = DB::table('permission_roles')->where('role_id', '=', $id)->get();
        return view('admin.role.edit', ['data'=>$data, 'permission'=>$permission, 'permissionChecked'=>$permissionChecked]);
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
        $role = Role::FindOrFail($id);
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::FindOrFail($id);
        $role->permissions()->detach(); 
        $role->delete();
        return response()->json([
             'status' => true,
            //  'url'
             200
            ]);
    }
}
