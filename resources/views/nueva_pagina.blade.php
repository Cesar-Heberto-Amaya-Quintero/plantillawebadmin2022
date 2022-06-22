@extends('layouts.base')
@section('titulo', 'Titulo')
@section('modulo', 'Modulo')
@section('seccion', 'Sección')

@section('estilos')

@endsection

@section('contenido')


<div class="row gy-5 g-xl-8">
    <div class="col-xs-12">
        <div class="card card-xl-stretch">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bolder mb-2 text-dark">Título de la página</span>
                    <span class="text-muted fw-bold fs-7">Subtítulo de la página</span>
                </h3>
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <button class="btn btn-primary btn-sm"> Herramienta </button>
                    
                    <!--end::Menu-->
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                {{-- Aquí va el contenido de la página --}}
            </div>
            <!--end: Card Body-->
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection