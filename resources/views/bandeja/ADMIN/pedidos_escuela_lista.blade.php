@extends('layout.app')

@section('Titulo', 'GretLaR - Lista de Pedidos')

@section('ContenidoPrincipal')

<section id="container">
    <section id="main-content">
        <section class="content-wrapper">
                <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Buscador Rec -->
                    <h4 class="text-center display-4">Lista de Pedidos Realizados</h4>
                    <!-- Agregar Nuevo Rec -->
                   
                  
                    <div class="row d-flex justify-content-center">
                        <!-- left column -->
                        <div class="col-md-10">
                            <div class="card card-lightblue">
                                <div class="card-header">
                                    <h3 class="card-title">Escuela: <b>{{$EscuelaInfo[0]->Descripcion}}</b> - CUE:<b>{{$EscuelaInfo[0]->CUE}} / {{$EscuelaInfo[0]->cuecompleto}}</b> </h3>&nbsp; 
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="alert alert-info alert-dismissible">
                                        <h5><i class="icon fas fa-info"></i> Informaci&oacute;n</h5>
                                        Escuela a Asignar: <b>{{$EscuelaInfo[0]->Descripcion}}</b> - CUE:<b>{{$EscuelaInfo[0]->CUE}} / {{$EscuelaInfo[0]->cuecompleto}}</b> 
                                    </div>
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">COD</th>
                                            <th class="text-center">Descripcion</th>
                                            <th class="text-center">Numero de Serie</th>
                                            <th class="text-center">Tipo de Recurso</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Observacion</th>
                                            <th class="text-center">Ver</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if($MisRecursos->count() >= 1)
                                                @foreach ($MisRecursos as $nag)
                                                    <tr>
                                                        <form method="POST" action="{{ route('cancelarPedido') }}" class="formularioNuevoPedido form-group">
                                                            @csrf
                                                            <td class="text-center">{{$nag->idPedido}}</td>
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
                                                                {{$nag->Nombre_Estado}}
                                                            </td>
                                                            <td class="text-center">{{$nag->Cantidad_Recurso}}</td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="Observacion">Observación</label><br>
                                                                    <textarea class="form-control" name="Observaciones" rows="3" cols="100%">{{$nag->ObservacionesPedido}}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Observacion">Observación del T&eacute;cnico</label><br>
                                                                    <textarea class="form-control" name="ObservacionesTecnico" rows="3" cols="100%">{{$nag->ObservacionesTecnico}}</textarea>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($nag->idTipoEstado > 3)
                                                                    <label>Se encuentra en manos del tecnico</label>
                                                                @else
                                                                <input type="hidden" name="recurso" value="{{$nag->idRecurso}}">
                                                                <input type="hidden" name="pedido" value="{{$nag->idPedido}}">
                                                                <button type="submit" name="btnAgregarAgenteNuevo" class="btn mx-1">
                                                                    <i class="fa fa-eraser text-red"></i><br>Cancelar Envio
                                                                </button>
                                                                @endif
                                                                    
                                                            </td>
                                                        </form>
                                                    </tr>  

                                                @endforeach
                                            @else
                                                <div class="alert alert-warning alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                                                    No se ha registrado ningún Pedido para Reparaci&oacute;n
                                                </div>
                                            @endif          
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
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
        @if (session('ConfirmarNuevoRecursoAgregado')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'El recurso fue agregado con exito en la Escuela Seleccionada',
                'success'
                    )
            </script>
        @endif

        @if (session('ConfirmarNuevoRecursoDevuelto')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'El recurso retorno a GretLaR con exito',
                'success'
                    )
            </script>
        @endif

        @if (session('ConfirmarRecursoEnvioST')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'El recurso fue enviado a Control',
                'success'
                    )
            </script>
        @endif
    <script>

    $('.formularioNuevoPedido').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Esta por realizar un pedido de reparacion servicio de GretLaR?',
            text: "Este cambio no puede ser borrado luego",
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
</script>

@endsection
