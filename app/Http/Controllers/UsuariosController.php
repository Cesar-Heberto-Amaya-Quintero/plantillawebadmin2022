<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function index () {
        $usuarios = User::all();
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
}
