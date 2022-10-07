<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Permisos = Permission::all();
        $Roles = Role::all();
        return  view('RolesPermisos.index',['Permisos'=>$Permisos, 'Roles'=>$Roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Permisos = Permission::all();
        return view('RolesPermisos.create',['Permisos'=>$Permisos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol_nombre'=>'required',
            'permisos'=>'required'
        ]);
        $permisos = $request->input('permisos');
        $rol = Role::create(['name' => $request->input('rol_nombre')]);
        foreach($permisos as $permiso){
            $permiso = Permission::find($permiso);
            $rol->givePermissionTo($permiso);
        }
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $rol)
    {
        $Permisos = $rol->permissions;
        return view('RolesPermisos.show',['rol'=>$rol, 'Permisos'=>$Permisos]);
    }
    public function asignarRol(){
        $Usuarios = User::all();
        $Roles = Role::all();
        return view( 'RolesPermisos.asignar',['Usuarios' => $Usuarios, 'Roles' => $Roles]);
    }
    public function storeAsignarRol(Request $request){
        $usuario = User::find($request->input('usuario'));
        $rol = Role::find($request->input('rol'));
        $usuario->assignRole($rol);
        return redirect()->route('roles.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $rol)
    {
        $Permisos = Permission::all();
        return view('RolesPermisos.edit',['rol'=>$rol, 'Permisos'=>$Permisos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Role $rol)
    {
        //Rebocar permisos
        $permisos = Permission::all();
        foreach($permisos as $permiso)
        $rol->revokePermissionTo($permiso->name);
        //asignar permisos
        $permisos = $request->input('permisos');
        foreach($permisos as $permiso){
            $permiso = Permission::find($permiso);
            $rol->givePermissionTo($permiso);
        }
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $rol)
    {
        $rol->delete();
        return redirect()->route('roles.index');
    }
}
