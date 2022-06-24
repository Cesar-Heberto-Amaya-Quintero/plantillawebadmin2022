@extends('layouts.base')
@section('titulo', 'Usuarios')
@section('modulo', 'Usuarios')
@section('seccion', 'Lista')

@section('estilos')
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>

@endsection

@section('contenido')

<div class="row gy-5 g-xl-8">
    <div class="col-xs-12">

        @if (Session::has('exito'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('exito')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif

        @if (Session::has('error'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif

        <div class="card card-xl-stretch">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bolder mb-2 text-dark">Usuarios</span>
                    <span class="text-muted fw-bold fs-7">Mostrando  usuarios</span>
                </h3>
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <a href=" {{ route('usuarios.create')}}" class="btn btn-primary btn-sm"> Nuevo </a>
                    
                    <!--end::Menu-->
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                
                <table id="tblClientes" class= "table"> 
                    <thead> 
                        <tr>
                            <th> Id </th>
                            <th> Nombre</th> 
                            <th> Correo</th> 
                            <th> Acciones</th> 
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($users as $usuario)
                        <tr>
                            <td> {{ $usuario->id}}</td> 
                            <td> {{ $usuario->name}}</td> 
                            <td> {{ $usuario->email}}</td> 
                            <td> 
                                <a href= '{{ route('usuarios.edit', $usuario->id)}}' class="btn btn-primary btn-sm" > 
                                    <i class= "fas fa-edit"> </i>
                                </a>

                                <a href= '#' class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmarEliminar" onclick=""> 
                                    <i class= "fas fa-times"> </i>
                                </a>

                                
                            </td> 
                        </tr>
                    @endforeach
                        
                    </tbody>

                </table>
            </div>
            <!--end: Card Body-->
        </div>

        
    </div>
</div>


<!-- Modal de confirmación para eliminar cliente -->
<div class="modal fade" id="confirmarEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que deseas eliminar al cliente <span id="lblIdCliente"> </span>: <span id="lblnombreCliente"> </span> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Recuerda que si eliminas a este cliente, ya no formará parte del catálogo del cliente.
      </div>
      <div class="modal-footer">
      <form id="frmEliminar" action="#" method="POST">
      @csrf
      @method('DELETE')
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script>
        function ajustarFormularioEliminar(id, nombre, ruta) {
            $("#lblIdCliente").text(id);
            $("#lblnombreCliente").text(nombre);
            $("#frmEliminar").attr('action', ruta);
        }

        $(function(){
            $("#tblClientes").DataTable();
        });
    </script>
@endsection