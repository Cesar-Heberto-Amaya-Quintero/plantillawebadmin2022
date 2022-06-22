@extends('layouts.base')
@section('titulo', 'Nuevo Cliente')
@section('modulo')
<a href=" {{ route('clientes.index')}}"> Clientes </a>
@endsection
@section('seccion', 'Nuevo cliente')

@section('contenido')


<div class="row gy-5 g-xl-8">
    <div class="col-xs-12">
        <div class="card card-xl-stretch">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bolder mb-2 text-dark">Clientes</span>
                    <span class="text-muted fw-bold fs-7">Crear nuevo cliente</span>
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
                        <form method="POST" action="{{ route('clientes.store')}}" enctype= "multipart/form-data">
                            @csrf
                            <div class="form-group mb-2" >
                                <label> Nombre </label>
                                <input name="nombre" id= "txtNombre" class="form-control" type="text" placeholder="Ingresa el nombre del cliente o comercio" required>
                            </div>

                            <div class="form-group mb-2">
                                <label> Tipo de cliente </label>
                                <select name="tipoCliente" id="slcTipoCliente" class="form-control" required> 
                                    <option value="" disabled selected> Elige un tipo de cliente </option>
                                    @foreach($tiposCliente as $tipoCliente)
                                        <option value="{{ $tipoCliente->id }}"> {{$tipoCliente->descripcion}} </option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div id= "grpConvenio" class="form-group mb-2">
                                <label> Convenio </label>
                                <input name="convenio" id= "txtConvenio" class="form-control" type="text" placeholder="Ingresa la clave del convenio">
                            </div>

                            <div class="form-group mb-2">
                                <label> Teléfono </label>
                                <input name="telefono" id= "txtTelefono" class="form-control" type="tel" placeholder="Ingresa el teléfono de contacto" required>
                            </div>

                            <div class="form-group mb-2">
                                <label> Correo electrónico </label>
                                <input name="correo" id= "txtCorreo" class="form-control" type="email" placeholder="Ingresa el correo electrónico de contacto" required>
                                <small class= "form-text"> Verifica que el correo electrónico sea válido, ya que a este correo se enviarán las facturas </small>
                            </div>

                            <div class="form-group mb-5">
                                <label> Foto(opcional) </label>
                                <input name="foto" id= "txtFoto" class="form-control" type="file">
                                
                            </div>

                            <div class="form-group mb-2" >

                                <button class="btn btn-primary" type="submit"> Crear nuevo cliente </button>
                                
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
    <script>
        function doChangeTipoCliente(e) {
            
            
            if (Number($('#slcTipoCliente').val()) == 1) {
                $('#grpConvenio').show();
                $('#txtConvenio').attr('required', 'required');
            }
            else {
                $('#grpConvenio').hide();
                $('#txtConvenio').removeAttr('required');
            }
        };
    //Lo que está dentro de la función se ejecuta hasta que se carga toda la página
        $(function() {
            $('#grpConvenio').hide();
            $('#slcTipoCliente').change(doChangeTipoCliente);

        });
    </script>
@endsection