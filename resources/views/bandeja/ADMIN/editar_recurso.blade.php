@extends('layout.app')

@section('Titulo', 'GretLaR - Editar Usuario ADMIN')

@section('ContenidoPrincipal')

<section id="container">
    <section id="main-content">
        <section class="content-wrapper">
                <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Buscador Agente -->
                    <h4 class="text-center display-4">Editar Recurso</h4>
                    <!-- Agregar Nuevo Agente -->
                    <div class="row d-flex justify-content-center">
                        <!-- left column -->
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="card card-green">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Editar Recurso
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                            
                                <form method="POST" action="{{ route('FormActualizarRecurso') }}" class="formularioActualizarRecurso form-group">
                                @csrf
                                    <div class="card-body" id="NuevoAgenteContenido1" style="display:visible">
                                        <!-- datos recursos -->
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="TR">Tipo de Recurso: </label>
                                                <select class="form-control" name="TipoRecurso" id="TipoRecurso">
                                                    @foreach ($TipoRecursos as $o )
                                                        @if ($o->idTipoRecurso == $Recursos[0]->idTipoRecurso)
                                                            <option value="{{$o->idTipoRecurso}}" selected="selected">{{$o->Nombre_Recurso}}</option>
                                                        @else
                                                            <option value="{{$o->idTipoRecurso}}">{{$o->Nombre_Recurso}}</option>
                                                        @endif
                                                    @endforeach    
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="Estado">Estado: </label>
                                                <select class="form-control" name="TipoEstado" id="TipoEstado">
                                                    @foreach ($TipoEstados as $o )
                                                        @if ($o->idTipoEstado == $Recursos[0]->idTipoEstado)
                                                            <option value="{{$o->idTipoEstado}}" selected="selected">{{$o->Nombre_Estado}}</option>
                                                        @else
                                                            <option value="{{$o->idTipoEstado}}">{{$o->Nombre_Estado}}</option>
                                                        @endif
                                                    @endforeach    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label for="Descripcion">Descripcion: </label>
                                                <input type="text" autocomplete="off" class="form-control" id="Descripcion" name="Descripcion" placeholder="Ingrese descripcion del producto" value="{{$Recursos[0]->Descripcion_Recurso}}">
                                            </div>
                                            <div class="col-4">
                                                <label for="Serie">Numero de Serie: </label>
                                                <input type="text" autocomplete="off" class="form-control" id="NumeroSerie" name="NumeroSerie" placeholder="Ingrese numero de serie si lo conoce" value="{{$Recursos[0]->Numero_Serie}}">
                                            </div>
                                            <div class="col-4">
                                                <label for="Cantidad">Cantidad: </label>
                                                <input type="number" autocomplete="off" class="form-control" id="Cantidad" name="Cantidad" placeholder="Ingrese cantidad de elementos" value="{{$Recursos[0]->Cantidad_Recurso}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="Observacion">Observación</label><br>
                                                <textarea class="form-control" name="Observaciones" rows="5" cols="100%">{{$Recursos[0]->Observaciones}}</textarea>
                                            </div>
                                        </div>
                                      
                                        <!-- /.card-body -->    
                                       
                                    </div>
                                    <!-- /.card-body -->
                                    <input type="hidden" name="datId" value="{{$Recursos[0]->idRecurso}}">
                                    <div class="card-footer bg-transparent" id="NuevoAgenteContenido2" style="display:visible">
                                        <button type="submit" class="btn btn-primary btn-block bg-success">Actualizar Información</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
         

                
            </section>
            <!-- /.content -->
        </section>
    </section>
</section>
@endsection

@section('Script')
    <script src="{{ asset('js/funcionesvarias.js') }}"></script>
        @if (session('ConfirmarActualizarRecurso')=='OK')
            <script>
            Swal.fire(
                'Registro Actualizado',
                'Se actualizo el Recurso Seleccionado',
                'success'
                    )
            </script>
        @endif
    <script>

    $('.formularioActualizarUsuario').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de querer actualizar el Usuario?',
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
