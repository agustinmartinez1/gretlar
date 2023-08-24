@extends('layout.app')

@section('Titulo', 'GretLaR - Nuevo Usuario ADMIN')

@section('ContenidoPrincipal')

<section id="container">
    <section id="main-content">
        <section class="content-wrapper">
                <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Buscador Agente -->
                    <h4 class="text-center display-4">Usuarios Creados</h4>
                    <div class="alert alert-info alert-dismissible justify-content-center col-md-10" style="margin:0 auto">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Alerta</h5>
                        Informaci&oacute;n: En esta lista, figuran los Roles: Administradores, Autogesti&oacute;n Escolar y T&eacute;cnicos.<br>
                        Puede usar el buscador para filtrar por cualquier dato presente y puede usar la ultima columna para editar los valores de una persona especifica.
                    </div>
                    <!-- Agregar Nuevo Agente -->
                   
                    <div class="row d-flex justify-content-center">
                        <!-- left column -->
                        <div class="col-md-10">
                            <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Usuarios en el Sistema(Admin y Técnicos)</h3>&nbsp; 
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>COD</th>
                                    <th>Apellido y Nombre</th>
                                    <th>Usuario(ALIAS)</th>
                                    <th>Rol</th>
                                    <th>Clave</th>
                                    <th>Correo Electronico</th>
                                    <th>Activo</th>
                                    <th>Fecha Alta</th>
                                    <th>Habilitado?</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($UsuariosLista as $nag)
                                         <tr>
                                            <td>{{$nag->idUsuario}}</td>
                                            <td>{{$nag->Nombre}}</td>
                                            <td>{{$nag->Usuario}}</td>
                                            <td>{{$nag->Descripcion}}</td>
                                            <td>{{$nag->Clave}}</td>
                                            <td>{{$nag->email}}</td>
                                            <td class="text-center">{{$nag->Activo}}</td>
                                            <td>{{$nag->created_at}}</td>
                                            <td>
                                                <a href="{{route('editarUsuario',$nag->idUsuario)}}" title="Editar Usuario">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                
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
