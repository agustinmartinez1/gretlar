@extends('layout.app')

@section('Titulo', 'GretLaR - Nuevo Recurso ADMIN')

@section('ContenidoPrincipal')

<section id="container">
    <section id="main-content">
        <section class="content-wrapper">
                <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Buscador Recurso -->
                    <h4 class="text-center display-4">Agregar Recurso</h4>
                    <!-- Agregar Nuevo Recurso -->
                    <div class="row d-flex justify-content-center">
                        <!-- left column -->
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="card card-lightblue">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Agregar Recurso Nuevo
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                            
                                <form method="POST" action="{{ route('FormNuevoRecurso') }}" class="formularioNuevoRecurso form-group">
                                @csrf
                                    <div class="card-body" id="NuevoAgenteContenido1" style="display:visible">
                                        
                                        <!-- datos recursos -->
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label for="TR">Tipo de Recurso: </label>
                                                <select class="form-control" name="TipoRecurso" id="TipoRecurso">
                                                    @foreach ($TipoRecursos as $o )
                                                        <option value="{{$o->idTipoRecurso}}">{{$o->Nombre_Recurso}}</option>
                                                    @endforeach    
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="Estado">Estado: </label>
                                                <select class="form-control" name="TipoEstado" id="TipoEstado">
                                                    @foreach ($TipoEstados as $o )
                                                        <option value="{{$o->idTipoEstado}}">{{$o->Nombre_Estado}}</option>
                                                    @endforeach    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label for="Descripcion">Descripcion: </label>
                                                <input type="text" autocomplete="off" class="form-control" id="Descripcion" name="Descripcion" placeholder="Ingrese descripcion del producto">
                                            </div>
                                            <div class="col-4">
                                                <label for="Serie">Numero de Serie: </label>
                                                <input type="text" autocomplete="off" class="form-control" id="NumeroSerie" name="NumeroSerie" placeholder="Ingrese numero de serie si lo conoce">
                                            </div>
                                            <div class="col-4">
                                                <label for="Cantidad">Cantidad: </label>
                                                <input type="number" autocomplete="off" class="form-control" id="Cantidad" name="Cantidad" placeholder="Ingrese cantidad de elementos">
                                            </div>
                                        </div>

                                       
                                    <!-- /.card-body -->

                                    <div class="card-footer bg-transparent" id="NuevoAgenteContenido2" style="display:visible">
                                        <button type="submit" class="btn btn-primary btn-block">Agregar</button>
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
        @if (session('ConfirmarNuevoRecurso')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'Se Agrego un Recurso Nuevo',
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
