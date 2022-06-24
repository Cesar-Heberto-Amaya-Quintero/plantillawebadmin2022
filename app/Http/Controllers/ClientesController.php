<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\TipoCliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }

    public function index () {
        $clientes = Cliente::where('activo', 1)->orderBy('id', 'DESC')->get();
        $argumentos['clientes'] = $clientes;

        return view('clientes.index', $argumentos);
    }

    public function create () {
        $argumentos = array();
        $tiposCliente = TipoCliente::all();
        $argumentos['tiposCliente'] = $tiposCliente;
        return view('clientes.create', $argumentos);
    }

    public function edit($id) {
        $argumentos = array();
        $cliente = Cliente::find($id);
        if($cliente) {
            $tiposCliente = TipoCliente::all();
            $argumentos['tiposCliente'] = $tiposCliente;
            $argumentos['cliente'] = $cliente;
            return view('clientes.edit', $argumentos);
        }
        return redirect()->route('clientes.index')->with('error', "No se encontró cliente $id");
        
    }

    public function store (Request $request) {
        $nuevoCliente = new Cliente();
        $tipoCliente = $request->input('tipoCliente');
        $nuevoCliente->id_tipo_cliente = $tipoCliente;

        if (intval($tipoCliente) == 1) {
            $nuevoCliente->convenio = $request->input('convenio');
        }

        $nuevoCliente->nombre = $request->input('nombre');
        $nuevoCliente->telefono = $request->input('telefono');
        $nuevoCliente->correo = $request->input('correo');

        //Si tiene un archivo llamado foto hacemos la rutina de guardado
        if($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/clientes');
            $nuevoCliente->foto = $request->file('foto')->hashName();
        }

        if ($nuevoCliente->save())
        {
            return redirect()->route('clientes.index')->with('exito',"Se ha guardado el cliente $nuevoCliente->nombre");
        }
        return redirect()->back()->with('error',"No se pudo guardar el nuevo cliente");
    }

    public function update(Request $request, $id) {
        $cliente = Cliente::find($id);
        if($cliente) {
            $tipoCliente = $request->input('tipoCliente');
            $cliente->id_tipo_cliente = $tipoCliente;

            if (intval($tipoCliente) == 1) {
                $cliente->convenio = $request->input('convenio');
            }
            else {
                $cliente->convenio = NULL;
            }

            $cliente->nombre = $request->input('nombre');
            $cliente->telefono = $request->input('telefono');
            $cliente->correo = $request->input('correo');
            // $cliente->password = bcrypt($request->input('password'));

            if($request->hasFile('foto')) {
                $path = $request->file('foto')->store('public/clientes');
                $cliente->foto = $request->file('foto')->hashName();
            }

            if ($cliente->save())
            {
                return redirect()->route('clientes.edit', $cliente->id)->with('exito',"Se ha actualizado el cliente $cliente->id");
            }
            return redirect()->back()->with('error',"No se pudo actualizar el cliente");
        }

        return redirect()->route('clientes.index')->with('error', "No se encontró cliente $id");
        
    }

    public function destroy($id) {
        $cliente = Cliente::find($id);
        if($cliente) {
            $cliente->activo = 0;
            if($cliente->save()) {
                //todo salió bien
                return redirect()->route('clientes.index')->with('exito', "Se ha eliminado al cliente $id: $cliente->nombre");
            }
            //Algo salió mal
            return redirect()->route('clientes.index')->with('error', "No se pudo eliminar al cliente $id");
        }
        return redirect()->route('clientes.index')->with('error', "No se encontró cliente $id");
    }
}
