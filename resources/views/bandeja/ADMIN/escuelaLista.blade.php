@extends('layout.app')

@section('Titulo', 'GretLaR - Lista de Escuelas')

@section('ContenidoPrincipal')

<section id="container">
    <section id="main-content">
        <section class="content-wrapper">
                <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Buscador Rec -->
                    <h4 class="text-center display-4">Listado General de Escuelas Habilitadas</h4>
                    <!-- Agregar Nuevo Rec -->
                   
                    <div class="row d-flex justify-content-center">
                        <!-- left column -->
                        <div class="col-md-10">
                            <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Escuelas</h3>&nbsp; 
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="alert alert-info alert-dismissible">
                                    <h5><i class="icon fas fa-info"></i> Informaci&oacute;n</h5>
                                    Seleccione una escuela para asignar recursos
                                  </div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">COD</th>
                                        <th class="text-center">Descripcion</th>
                                        <th class="text-center">CUE</th>
                                        <th class="text-center">CUE-Completo</th>
                                        <th class="text-center">Cant. Rec. Asignados</th>
                                        <th class="text-center">Ver</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($EscuelasHabilitadas->count() >= 1)
                                            @foreach ($EscuelasHabilitadas as $nag)
                                                <tr>
                                                    <td class="text-center">{{$nag->idSubOrganizacion}}</td>
                                                    <td>{{$nag->Descripcion}}</td>
                                                    <td class="text-center">{{$nag->CUE}}</td>
                                                    <td class="text-center">{{$nag->cuecompleto}}</td>
                                                    <td class="text-center">
                                                    @php
                                                        $CantRecursos = DB::table('tb_repositorio')
                                                        ->where('tb_repositorio.idSubOrganizacion',$nag->idSubOrganizacion)
                                                        ->get();
                                                        echo $CantRecursos->count();
                                                    @endphp
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{route('asignarRecursoEscuela',$nag->idSubOrganizacion)}}" title="Asignar Recurso a Escuela">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                    </td>
                                                </tr>                                        
                                            @endforeach
                                        @else
                                            <div class="alert alert-warning alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                                                No se encontraron escuelas habilitadas
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
    
</script>

@endsection
