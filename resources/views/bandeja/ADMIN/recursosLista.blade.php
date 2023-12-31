@extends('layout.app')

@section('Titulo', 'GretLaR - Nuevo Usuario ADMIN')

@section('ContenidoPrincipal')

<section id="container">
    <section id="main-content">
        <section class="content-wrapper">
                <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Buscador Rec -->
                    <h4 class="text-center display-4">Recursos en GretLaR</h4>
                    <div class="alert alert-info alert-dismissible justify-content-center col-md-10" style="margin:0 auto">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Alerta</h5>
                        Informaci&oacute;n: En este panel, se podra editar un recurso, borrarlo si fuera necesario y observar sus disponibilidades

                    </div>
                    <!-- Agregar Nuevo Rec -->
                   
                    <div class="row d-flex justify-content-center">
                        <!-- left column -->
                        <div class="col-md-10">
                            <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Recursos Agregados</h3>&nbsp; 
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">COD</th>
                                    <th class="text-center">Descripcion</th>
                                    <th class="text-center">Numero de Serie</th>
                                    <th class="text-center">Tipo de Recurso</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Observacion</th>
                                    <th class="text-center">Lo Registro?</th>
                                    <th class="text-center">Alta</th>
                                    <th class="text-center">Ver</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($RecursosLista->count() >= 1)
                                        @foreach ($RecursosLista as $nag)
                                            <tr>
                                                <td class="text-center">{{$nag->idRecurso}}</td>
                                                <td class="text-center">{{$nag->Descripcion_Recurso}}</td>
                                                <td class="text-center">{{$nag->Numero_Serie}}</td>
                                                <td class="text-center">{{$nag->Nombre_Recurso}}</td>
                                                @php
                                                $color="";
                                                    if($nag->idTipoEstado == 1) $color="green";
                                                    if($nag->idTipoEstado == 2) $color="red";
                                                    if($nag->idTipoEstado == 9) $color="#28B463";

                                                    if($nag->idTipoEstado == 3) $color="#FCF3CF";   //tono amarillo claro
                                                    if($nag->idTipoEstado == 4) $color="#AED6F1";   //tono amarillo claro
                                                    if($nag->idTipoEstado == 5) $color="#58D68D";   //tono amarillo claro
                                                    if($nag->idTipoEstado == 6) $color="#8C4966";   //tono rosado-morado
                                                    if($nag->idTipoEstado == 7) $color="#8C4966";   //idem
                                                    if($nag->idTipoEstado == 8) $color="#117864";   //tono amarillo claro
                                                @endphp
                                                <td class="text-center" style="background-color: {{$color}}">
                                                    @if ($nag->idTipoEstado >= 3 && $nag->idTipoEstado <= 8)
                                                        <i class="fa fa-cog"> {{$nag->Nombre_Estado}}</i>
                                                    @else
                                                        {{$nag->Nombre_Estado}}
                                                    @endif    
                                                </td>
                                                <td class="text-center">{{$nag->Cantidad_Recurso}}</td>
                                                <td>{{$nag->Observaciones}}</td>
                                                <td class="text-center">{{$nag->Nombre}}({{$nag->Descripcion}})</td>
                                                <td class="text-center">{{$nag->FechaAlta}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('editarRecurso',$nag->idRecurso)}}" title="Editar Recurso">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('eliminarRecurso',$nag->idRecurso)}}" class="EliminarRecurso{{$nag->idRecurso}}" title="Eliminar Recurso">
                                                        <i class="fa fa-eraser text-red"></i>
                                                    </a>
                                                </td>
                                            </tr>                                        
                                        @endforeach
                                    @else
                                        <div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                                            No se ha registrado ningún Recurso
                                        </div>
                                    @endif          
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            </div>
                        </div>
                    </div>    
            </section>
            <!-- /.content -->
        </section>
    </section>
</section>
@endsection

@section('Script')
    <script src="{{ asset('js/funcionesvarias.js') }}"></script>
        @if (session('ConfirmarNuevoUsuario')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'Se creo un nuevo registro de un Usuario',
                'success'
                    )
            </script>
        @endif

        @if (session('ConfirmarBorradoRecurso')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'Se Borro un Recurso',
                'success'
                    )
            </script>
        @endif
    <script>

    $('.formularioNuevoUsuario').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de querer agregar el Usuario?',
            text: "Este cambio no puede ser borrado luego, y debera ser validado por RRHH!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, crear el registro!'
          }).then((result) => {
            if (result.isConfirmed) {
              this.submit();
            }
          })
    })
    
    $('.EliminarRecurso'.{{$nag->idRecurso}}).click(function(e){
       e.preventDefault(); 
        Swal.fire({
            title: 'Esta seguro de querer borrar el recurso?',
            text: "Esta accion no tiene punto de retroceso",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, guardo el registro!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = $('.EliminarRecurso').attr('href');
            }else{
                return false;
            }
          })
    })
</script>

@endsection
