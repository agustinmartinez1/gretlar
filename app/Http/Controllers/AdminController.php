<?php

namespace App\Http\Controllers;

use App\Models\RecursoModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UsuarioModel;
use APP\Models\ReparticionModel;

class AdminController extends Controller
{
    public function nuevoUsuario(){
        //extras a enviar
        $TiposDeDocumentos = DB::table('tb_tiposdedocumento')->get();
        $TiposDeAgentes = DB::table('tb_tiposdeagente')->get();
        $Sexos = DB::table('tb_sexo')->get();
        $EstadosCiviles = DB::table('tb_estadosciviles')->get();
        $Nacionalidades = DB::table('tb_nacionalidad')->get();
        //se agrego el 18 abril
        /*$RelSubOrgAgente = DB::table('tb_suborg_agente')
        ->join('tb_agentes', 'tb_agentes.idAgente', '=', 'tb_suborg_agente.idAgente')
        ->join('tb_tiposdeagente', 'tb_tiposdeagente.idTipoAgente', '=', 'tb_agentes.TipoAgente')
        ->join('tb_suborganizaciones', 'tb_suborganizaciones.idSubOrganizacion', '=', 'tb_suborg_agente.idSubOrg')
        ->where('tb_suborg_agente.idSubOrg', session('idSubOrganizacion'))
        ->select(
            'tb_agentes.*',
            'tb_suborganizaciones.*',
            'tb_tiposdeagente.*',
            'tb_suborg_agente.*'
        )
        ->get();*/

        //dd($RelSubOrgAgente);
        $datos=array(
            'mensajeError'=>"",
            'mensajeNAV'=>'Panel de Creación de Usuarios',
            //'RelSubOrgAgente'=>$RelSubOrgAgente
        );
        //dd($infoPlaza);
        return view('bandeja.ADMIN.nuevo_usuario',$datos);
    }

    public function editarUsuario($idUsuario){
        //extras a enviar
        $TiposDeDocumentos = DB::table('tb_tiposdedocumento')->get();
        $TiposDeAgentes = DB::table('tb_tiposdeagente')->get();
        $Sexos = DB::table('tb_sexo')->get();
        $EstadosCiviles = DB::table('tb_estadosciviles')->get();
        $Nacionalidades = DB::table('tb_nacionalidad')->get();
        $Modos = DB::table('tb_modos')
        ->where(function ($query) {
            $query->where('tb_modos.idModo', '=', 1)
                ->orWhere('tb_modos.idModo', '=', 3);
        })
        ->get();

        $Usuario = DB::table('tb_usuarios')
        ->where('tb_usuarios.Modo','!=',2)
        ->where('tb_usuarios.idusuario',$idUsuario) //es and
        ->get();
        //dd($RelSubOrgAgente);
        $datos=array(
            'mensajeError'=>"",
            'mensajeNAV'=>'Panel de Creación de Usuarios',
            'Usuario'=>$Usuario,
            'Modos'=>$Modos
        );
        //dd($infoPlaza);
        return view('bandeja.ADMIN.editar_usuario',$datos);
    }
    public function FormNuevoUsuario(Request $request){
        //voy a omitir por ahora la comprobacion de agentes por DNI

        
        //dd($request);
        /*
       "_token" => "cCCSqEM9WUgc0Homrv4kAJgvZe9MpQCyJuMh7ure"
      "Apellido" => "loyola"            listo
      "Nombre" => "leo"                 listo
      "Activo" => "S"                   listo
      "Usuario" => "Leo Loyola"         listo
      "Clave" => "123"                  listo
      "Correo" => "djmov@gmail.com"     listo
      'Modo' se agrego
        */
       
        $o = new UsuarioModel();
          $o->Nombre = strtoupper($request->Apellido)." ".strtoupper($request->Nombre);
          $o->Clave = $request->Clave;
          $o->Usuario = $request->Usuario;
          $o->Activo = $request->Activo;
          $o->Email = $request->Correo;
          $o->idReparticion = 1;
          $o->Nivel = 119;
          $o->Modo = 3;     //3 es STec, 2 es para las escuelas  y 1 para admin
          $o->Dependencia = 1;
        $o->save();
          
         return redirect("/nuevoUsuario")->with('ConfirmarNuevoUsuario','OK');
         //LuiController::PlazaNueva($request->idSurOrg);

    }

    public function usuariosLista(){
        //extras a enviar
        /*$Usuarios = DB::table('tb_usuarios')
        ->where('tb_usuarios.Modo','=',1)
        ->get();*/

        //consulta trayendo un rango dado
        $Usuarios = DB::table('tb_usuarios')
        ->join('tb_modos', 'tb_modos.idModo', '=', 'tb_usuarios.Modo')
            ->where(function ($query) {
                $query->where('tb_usuarios.Modo', '=', 1)
                    ->orWhere('tb_usuarios.Modo', '=', 3);
            })
        ->get();
       
       
        //dd($RelSubOrgAgente);
        $datos=array(
            'mensajeError'=>"",
            'UsuariosLista'=>$Usuarios,
            'mensajeNAV'=>'Panel de Configuración de Usuarios',
            
        );
        //dd($infoPlaza);
        return view('bandeja.ADMIN.usuariosLista',$datos);
    }

    public function FormActualizarUsuario(Request $request){
        //voy a omitir por ahora la comprobacion de agentes por DNI

        
        //dd($request);
        /*
       "_token" => "cCCSqEM9WUgc0Homrv4kAJgvZe9MpQCyJuMh7ure"
      "Apellido" => "loyola"            listo
      "Nombre" => "leo"                 listo
      "Activo" => "S"                   listo
      "Usuario" => "Leo Loyola"         listo
      "Clave" => "123"                  listo
      "Correo" => "djmov@gmail.com"     listo
      'Modo se agrego
        */
        
        $o = UsuarioModel::where('idUsuario', $request->us)->first();
          $o->Nombre = strtoupper($request->Nombre);
          $o->Clave = $request->Clave;
          $o->Usuario = $request->Usuario;
          $o->Activo = $request->Activo;
          $o->Email = $request->Correo;
          $o->Modo = $request->Modo;
        $o->save();
        
        $idUs=$request->us;
         return redirect("/editarUsuario/$idUs")->with('ConfirmarActualizarUsuario','OK');
         //LuiController::PlazaNueva($request->idSurOrg);

    }

    //recursos
    public function nuevoRecurso(){
        //extras a enviar
        $TiposDeRecursos = DB::table('tb_tipo_recursos')->get();
        $TiposDeEstados = DB::table('tb_tipo_estados')
        ->where(function ($query) {
            $query->where('tb_tipo_estados.idTipoEstado', '=', 1)
                ->orWhere('tb_tipo_estados.idTipoEstado', '=', 2)
                ->orWhere('tb_tipo_estados.idTipoEstado', '=', 9);
        })
        ->get();
                
        $datos=array(
            'mensajeError'=>"",
            'mensajeNAV'=>'Panel de Creación de Recursos',
            'UsuarioAdmin'=> session('idUsuario'),
            'TipoRecursos'=>$TiposDeRecursos,
            'TipoEstados'=>$TiposDeEstados
        );

        return view('bandeja.ADMIN.nuevo_recurso',$datos);
    }

    public function FormNuevoRecurso(Request $request){
        //voy a omitir por ahora la comprobacion de agentes por DNI

        
        //dd($request);
        /*
         "_token" => "jvyhiHKVCgZiCD398icTWpPaDqpJDaYOsgjOUvdx"
        "TipoRecurso" => "2"
        "TipoEstado" => "1"
        "Descripcion" => "Notebook Bangoh"
        "NumeroSerie" => "ABC12345421"
        "Cantidad" => "1"
        */
       
        $o = new RecursoModel();
          $o->Descripcion_Recurso = strtoupper($request->Descripcion);
          $o->idTipoRecurso = $request->TipoRecurso;
          $o->idTipoEstado = $request->TipoEstado;
          $o->Numero_Serie = $request->NumeroSerie;
          $o->Cantidad_Recurso = $request->Cantidad;
          $o->idUsuario = session('idUsuario');
        $o->save();
          
         return redirect("/nuevoRecurso")->with('ConfirmarNuevoRecurso','OK');

    }
    public function recursosLista(){
     //extras a enviar

        //consulta de recursos, todos
        $Recursos = DB::table('tb_recursos')
        ->join('tb_usuarios', 'tb_usuarios.idUsuario', '=', 'tb_recursos.idUsuario')
        ->join('tb_modos', 'tb_modos.idModo', '=', 'tb_usuarios.Modo')
        ->join('tb_tipo_recursos', 'tb_tipo_recursos.idTipoRecurso', '=', 'tb_recursos.idTipoRecurso')
        ->join('tb_tipo_estados', 'tb_tipo_estados.idTipoEstado', '=', 'tb_recursos.idTipoEstado')
        ->select(
            'tb_usuarios.*',
            'tb_modos.*',
            'tb_recursos.*',
            'tb_recursos.created_at as FechaAlta',
            'tb_tipo_recursos.*',
            'tb_tipo_estados.*'
        )
        ->get();
       
       
        //dd($RelSubOrgAgente);
        $datos=array(
            'mensajeError'=>"",
            'RecursosLista'=>$Recursos,
            'mensajeNAV'=>'Panel de Configuración de Recursos',
            
        );
        //dd($infoPlaza);
        return view('bandeja.ADMIN.recursosLista',$datos);       
    }

    public function editarRecurso($idRecurso){
        //extras a enviar
        $TiposDeRecursos = DB::table('tb_tipo_recursos')->get();
        $TiposDeEstados = DB::table('tb_tipo_estados')
        ->where(function ($query) {
            $query->where('tb_tipo_estados.idTipoEstado', '=', 1)
                ->orWhere('tb_tipo_estados.idTipoEstado', '=', 2)
                ->orWhere('tb_tipo_estados.idTipoEstado', '=', 9);
        })
        ->get();
 
        $Recursos = DB::table('tb_recursos')
        ->join('tb_usuarios', 'tb_usuarios.idUsuario', '=', 'tb_recursos.idUsuario')
        ->join('tb_modos', 'tb_modos.idModo', '=', 'tb_usuarios.Modo')
        ->join('tb_tipo_recursos', 'tb_tipo_recursos.idTipoRecurso', '=', 'tb_recursos.idTipoRecurso')
        ->join('tb_tipo_estados', 'tb_tipo_estados.idTipoEstado', '=', 'tb_recursos.idTipoEstado')
        ->where('tb_recursos.idRecurso',$idRecurso) 
        ->select(
            'tb_usuarios.*',
            'tb_modos.*',
            'tb_recursos.*',
            'tb_recursos.created_at as FechaAlta',
            'tb_tipo_recursos.*',
            'tb_tipo_estados.*'
        )
        ->get();
        $datos=array(
            'mensajeError'=>"",
            'mensajeNAV'=>'Panel de Modificacion de Recursos',
            'TipoRecursos'=>$TiposDeRecursos,
            'TipoEstados'=>$TiposDeEstados,
            'Recursos'=>$Recursos
        );
        //dd($infoPlaza);
        return view('bandeja.ADMIN.editar_recurso',$datos);
    }

    public function FormActualizarRecurso(Request $request){

        //dd($request);
        /*
        "TipoRecurso" => "3"
        "TipoEstado" => "1"
        "Descripcion" => "Samsung S6 Lite"
        "NumeroSerie" => "DSataXXX"
        "Cantidad" => "1"
        "datId" => "1"
        */
        
        $o = RecursoModel::where('idRecurso', $request->datId)->first();
            $o->Descripcion_Recurso = strtoupper($request->Descripcion);
            $o->idTipoRecurso = $request->TipoRecurso;
            $o->idTipoEstado = $request->TipoEstado;
            $o->Numero_Serie = $request->NumeroSerie;
            $o->Cantidad_Recurso = $request->Cantidad;
        $o->save();
        
        $idRec=$request->datId;
         return redirect("/editarRecurso/$idRec")->with('ConfirmarActualizarRecurso','OK');

    }






























}
