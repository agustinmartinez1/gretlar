@extends('layout.app')

@section('Titulo', 'GretLaR - Control de Estadistica')

@section('ContenidoPrincipal')

<section id="container">
    <section id="main-content">
        <section class="content-wrapper">
                <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Buscador Agente -->
                    <h4 class="text-center display-4">Estad&iacute;sticas</h4>
                    <div class="alert alert-info alert-dismissible justify-content-center col-md-10" style="margin:0 auto">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Alerta</h5>
                        Informaci&oacute;n: En esta zona, podra observar una vista rapida de valores estad&iacute;sticos de las tablas
                    </div>
                    {{-- escuelas --}}
                    <div class="card col-md-10" style="margin:0 auto">
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Escuelas
                          </h3>
          
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        {{-- consultas --}}
                        @php
                            $cantEscuelas = DB::table('tb_suborganizaciones')->get();
                            $EscuelasHabilitadas = DB::table('tb_suborganizaciones')
                            ->join('tb_reparticiones', 'tb_reparticiones.subOrganizacion', '=', 'tb_suborganizaciones.idSubOrganizacion')
                            ->select(
                                'tb_suborganizaciones.*',
                                'tb_reparticiones.*'
                            )
                            ->get();
                            $cantRecursos = DB::table('tb_recursos')->get();
                        @endphp
                        <div class="card-body">
                          <div class="row">
                            <div class="col-6 col-md-3 text-center">
                              <input type="text" class="knob" value="{{$cantEscuelas->count()}}" data-width="90" data-height="90" data-fgColor="#3c8dbc">
          
                              <div class="knob-label">Cantidad de Escuelas</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                              <input type="text" class="knob" value="{{$EscuelasHabilitadas->count()}}" data-width="90" data-height="90" data-fgColor="#f56954">
          
                              <div class="knob-label">Escuelas Habilitadas</div>
                            </div>
                            <!-- ./col -->
                           
                          </div>
                          <!-- /.row -->
                        </div>

                        
                    </div>
                    <br>
                    {{-- usuarios --}}
                    <div class="card col-md-10" style="margin:0 auto">
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Usuarios
                          </h3>
          
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        {{-- consultas --}}
                        @php
                            $cantUsuariosAdmin = DB::table('tb_usuarios')
                            ->where('Modo','=',1)->get();
                            $cantUsuariosAuto = DB::table('tb_usuarios')
                            ->where('Modo','=',2)->get();
                            $cantUsuariosST = DB::table('tb_usuarios')
                            ->where('Modo','=',3)->get();
                            $cantUsuariosTotales = DB::table('tb_usuarios')->get();
                            
                        @endphp
                        <div class="card-body">
                          <div class="row">
                            <div class="col-6 col-md-3 text-center">
                              <input type="text" class="knob" value="{{$cantUsuariosTotales->count()}}" data-width="90" data-height="90" data-fgColor="#3c8dbc">
          
                              <div class="knob-label">Usuarios Totales</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                              <input type="text" class="knob" value="{{$cantUsuariosAdmin->count()}}" data-width="90" data-height="90" data-fgColor="#f56954">
          
                              <div class="knob-label">Usuarios Administradores</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                              <input type="text" class="knob" value="{{$cantUsuariosAuto->count()}}" data-min="-150" data-max="150" data-width="90"
                                     data-height="90" data-fgColor="#00a65a">
          
                              <div class="knob-label">Usuarios AutoGestion</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                              <input type="text" class="knob" value="{{$cantUsuariosST->count()}}" data-width="90" data-height="90" data-fgColor="#00c0ef">
          
                              <div class="knob-label">Usuarios Servicio T&eacute;cnico</div>
                            </div>
                            <!-- ./col -->
                          </div>
                          <!-- /.row -->
          
                         
                        </div>

                     
                    </div>

                    {{-- recursos --}}
                    <div class="card col-md-10" style="margin:0 auto">
                        <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Recursos
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                        </div>
                        <!-- /.card-header -->
                        {{-- consultas --}}
                        @php
                            
                            
                            $cantRecursosTotales = DB::table('tb_recursos')->get();
                            $cantRecursosEstado1 = DB::table('tb_recursos')
                            ->where('idTipoEstado','=',1)->get();   //disponible
                            $cantRecursosEstado2 = DB::table('tb_recursos')
                            ->where('idTipoEstado','=',2)->get();   //no disponible
                            $cantRecursosEstado9 = DB::table('tb_recursos')
                            ->where('idTipoEstado','=',9)->get();   //asignado

                            $cantRecursosEstado35 = DB::table('tb_recursos')
                            ->where(function ($query) {
                            $query->where('idTipoEstado', '=', 3)
                                ->orWhere('idTipoEstado', '=', 4)
                                ->orWhere('idTipoEstado', '=', 5);
                                })->get();  //en reparacion
                            
                            $cantRecursosEstado6 = DB::table('tb_recursos')
                            ->where('idTipoEstado','=',6)->get();   //sin solucion

                            $cantRecursosEstado7 = DB::table('tb_recursos')
                            ->where('idTipoEstado','=',7)->get();   //sin repuesto
                        @endphp
                        <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{$cantRecursosTotales->count()}}" data-width="90" data-height="90" data-fgColor="#3c8dbc">

                            <div class="knob-label">Cantidad Recursos</div>
                            </div>

                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{$cantRecursosEstado1->count()}}" data-width="90" data-height="90" data-fgColor="#f56954">

                            <div class="knob-label">Disponibles</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" class="knob" value="{{$cantRecursosEstado2->count()}}" data-width="90" data-height="90" data-fgColor="#f56954">
    
                                <div class="knob-label">No Disponibles</div>
                                </div>
                                <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{$cantRecursosEstado9->count()}}" data-min="-150" data-max="150" data-width="90"
                                    data-height="90" data-fgColor="#00a65a">

                            <div class="knob-label">Asignados</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{$cantRecursosEstado35->count()}}" data-width="90" data-height="90" data-fgColor="#00c0ef">

                            <div class="knob-label">En Reparaci&oacute;n</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" class="knob" value="{{$cantRecursosEstado6->count()}}" data-width="90" data-height="90" data-fgColor="#f56954">
    
                                <div class="knob-label">Sin Soluci&oacute;n</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-6 col-md-3 text-center">
                                <input type="text" class="knob" value="{{$cantRecursosEstado7->count()}}" data-width="90" data-height="90" data-fgColor="#f56954">
        
                                <div class="knob-label">Sin Repuestos</div>
                                </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->

                        
                        </div>

                    
                    </div>
                </div><!-- /.container-fluid -->
         

                
            </section>
            <!-- /.content -->
        </section>
    </section>
</section>
@endsection

@section('Script')


@endsection
