@extends('layouts.base')
@section('titulo', 'Nuevo Usuario')
@section('modulo')
<a href=" {{ route('usuarios.index')}}"> Usuarios </a>
@endsection
@section('seccion', 'Nuevo Usuario')

@section('contenido')


<div class="row gy-5 g-xl-8">
    <div class="col-xs-12">
        <div class="card card-xl-stretch">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bolder mb-2 text-dark">Usuarios</span>
                    <span class="text-muted fw-bold fs-7">Crear nuevo usuario</span>
                </h3>
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    
                    <!--end::Menu-->
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                {{-- Aquí va el contenido de la página --}}
                <div class="row">
                    <div class="col mb-8">
                        <form method="POST" action="{{ route('usuarios.store')}}" enctype= "multipart/form-data">
                            @csrf
                            <div class="form-group mb-2" >
                                <label> Nombre </label>
                                <input name="nombre" id= "txtNombre" class="form-control" type="text" placeholder="Ingresa el nombre del usuario" required>
                            </div>

                            <div class="form-group mb-2">
                                <label> Correo electrónico </label>
                                <input name="correo" id= "txtCorreo" class="form-control" type="email" placeholder="Ingresa el correo electrónico del usuario" required>
                                <small class= "form-text"> Verifica que el correo electrónico sea válido, ya que a este correo se enviarán las facturas </small>
                            </div>

                            <div class="form-group mb-2" >
                                <label> Contraseña </label>
                                <input name="contrasena" id= "txtContrasena" class="form-control" type="password" placeholder="Ingresa la contraseña" required>
                            </div>

                            <div class="form-group mb-5">
                                <label> Foto(opcional) </label>
                                <input name="foto" id= "txtFoto" class="form-control" type="file">
                                
                            </div>

                            <div class="form-group mb-2" >

                                <button class="btn btn-primary" type="submit"> Crear nuevo usuario </button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end: Card Body-->
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection