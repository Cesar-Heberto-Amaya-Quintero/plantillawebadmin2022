<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function index () {
        // $usuarios = User::all();
        $usuarios = User::where('activo', 1)->orderBy('id', 'DESC')->get();
        $argumentos['users'] = $usuarios;

        return view('usuarios.index', $argumentos);
    }

    public function create () {
        
        return view('usuarios.create');
    }

    public function edit($id) {
        $argumentos = array();
        $usuario = User::find($id);
        if($usuario) {
            $argumentos['usuario'] = $usuario;
            return view('usuarios.edit', $argumentos);
        }
        return redirect()->route('usuarios.index')->with('error', "No se encontró usuario $id");
        
    }

    public function store (Request $request) {
        $nuevoUsuario = new User();


        $nuevoUsuario->name = $request->input('nombre');
        $nuevoUsuario->email = $request->input('correo');
        $nuevoUsuario->password = bcrypt($request->input('contrasena'));

        //Si tiene un archivo llamado foto hacemos la rutina de guardado
        if($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/usuarios');
            $nuevoUsuario->foto = $request->file('foto')->hashName();
        }

        if ($nuevoUsuario->save())
        {
            return redirect()->route('usuarios.index')->with('exito',"Se ha guardado el usuario $nuevoUsuario->nombre");
        }
        return redirect()->back()->with('error',"No se pudo guardar el nuevo usuario");
    }

    public function update(Request $request, $id) {
        $usuario = User::find($id);
        if($usuario) {

            $usuario->name = $request->input('nombre');
            $usuario->email = $request->input('correo');
            // $usuario->password = bycript($request->input('contrasena'));


            if($request->hasFile('foto')) {
                $path = $request->file('foto')->store('public/usuarios');
                $usuario->foto = $request->file('foto')->hashName();
            }

            if ($usuario->save())
            {
                return redirect()->route('usuarios.edit', $usuario->id)->with('exito',"Se ha actualizado el usuario $usuario->id");
            }
            return redirect()->back()->with('error',"No se pudo actualizar el usuario");
        }

        return redirect()->route('usuarios.index')->with('error', "No se encontró usuario $id");
        
    }

    public function destroy($id) {
        $usuario = User::find($id);
        if($usuario) {
            $usuario->activo = 0;
            if($usuario->save()) {
                //todo salió bien
                return redirect()->route('usuarios.index')->with('exito', "Se ha eliminado al usuario $id: $usuario->nombre");
            }
            //Algo salió mal
            return redirect()->route('usuarios.index')->with('error', "No se pudo eliminar al usuario $id");
        }
        return redirect()->route('usuarios.index')->with('error', "No se encontró usuario $id");
    }
}

