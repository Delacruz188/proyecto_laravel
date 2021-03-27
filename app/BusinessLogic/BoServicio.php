<?php
namespace App\BusinessLogic;
Use App\model\TipoServicio;
Use App\model\Servicio;
Use App\model\Horario;
Use App\model\Personal;
Use App\model\Socio;
Use App\model\Usuario;

class BoServicio{
    function pagar_servicio($objeto){
        $resultado = new \StdClass();
        $servicio=Servicio::find($objeto->idservicio);
        if ($servicio->status==1) {
            $servicio->status = 2;
            $servicio->save();
            $resultado = 'OK';

        }else {
                $resultado->status = 'ERROR';
        }
        return $resultado;
    }
    function obten_servicios($objeto){
       $consulta=Servicio::join('socio','socio.idsocio','=','servicio.idsocio')
                            ->join('tiposervicio','tiposervicio.idtiposervicio','=','servicio.idtiposervicio')
                            ->join('estacion','estacion.idestacion','=','servicio.idestacion')
                            ->join('usuario','usuario.idusuario','=','socio.idusuario')
                            ->select(
                                \DB::Raw("servicio.idhorario as fila"),
                                \DB::Raw("servicio.idestacion as columna"),
                                \DB::Raw("socio.nombre as cliente"),
                                \DB::Raw("tiposervicio.nombre as tipo"),
                                \DB::Raw("DATE_FORMAT(fecha_atencion_inicial, '%Y-%m-%d %H:%i:%i') as fecha_atencion_inicial"),
                                "estacion.nomestacion",
                                "servicio.placa",
                                "servicio.modelo",
                                "servicio.anio",
                                "servicio.precio",
                                "servicio.idservicio",
                                "usuario.email"

                            );
        if(isset($objeto->fecha)){
            $consulta->whereRaw("DATE_FORMAT(fecha_atencion_inicial, '%Y-%m-%d')='".$objeto->fecha."'");
        }
        if(isset($objeto->idservicio)){
            
            $consulta->where("idservicio",$objeto->idservicio);
        }
        return $consulta->get();
    }


    function valida_horario($objeto){
        $bandera=1;
        $servicios=Servicio::where('idestacion',$objeto->idestacion)
                            ->whereRaw("fecha_atencion_inicial<'".$objeto->fa_final."' and fecha_atencion_final>'".$objeto->fa_inicial."'")
                            ->get();
        if (count($servicios)!=0) {
            $bandera=0;
        }
        return $bandera;
    }
    function registrar_servicio($objeto){
        $resultado=new \StdClass();
        if(!isset($objeto->fecha_registro)){
            $objeto->fecha_registro=date('Y-m-d H:i:s');
        }
        if(!isset($objeto->origen)){
            $objeto->origen='LOCAL';
        }
        if(!isset($objeto->precio)){
            $tipo=TipoServicio::find($objeto->idtiposervicio);
            $objeto->precio=$tipo->precio;
        }
        if(!isset($objeto->fa_inicial)){
            $horario=Horario::find($objeto->idhorario);
            $objeto->fa_inicial=$objeto->fechaservicio.' '.$horario->hora_inicial;
            $objeto->fa_final=$objeto->fechaservicio.' '.$horario->hora_final;
        }
        if(!isset($objeto->idpersonal)){
            $personal=Personal::where('curp',$objeto->curp)->first();
            $objeto->idpersonal=$personal->idpersonal;
           
        }

        $bandera=$this->valida_horario($objeto);
        




        if ($bandera==1) {
            $resultado->status="OK";
            $resultado->mensaje="";
            $servicio=new Servicio();
            $servicio->placa=$objeto->placa;
            $servicio->modelo=$objeto->modelo;
            $servicio->status=1;
            $servicio->anio=$objeto->anio;
            $servicio->precio=$objeto->precio;
            $servicio->idtiposervicio=$objeto->idtiposervicio;
            $servicio->idpersonal=$objeto->idpersonal;
            $servicio->idsocio=$objeto->idsocio;
            $servicio->fecharegistro=$objeto->fecha_registro;
            $servicio->fecha_atencion_inicial=$objeto->fa_inicial;
            $servicio->fecha_atencion_final=$objeto->fa_final;
            $servicio->idestacion=$objeto->idestacion;
            $servicio->idhorario=$objeto->idhorario;
            $servicio->origen=$objeto->origen;
            $servicio->save();
            $resultado->servicio=$servicio;
            $socio2=Socio::find($servicio->idsocio);
            $tipo2=Tiposervicio::find($servicio->idtiposervicio);
            $usuario2=Usuario::find($socio2->idusuario);
            $resultado->cliente=$socio2->nombre;
            $resultado->tipo=$tipo2->nombre;
            $resultado->email=$usuario2->email;
        }else {
            $resultado->status="Error";
            $resultado->mensaje="La estacion no esta disponoble para la fecha y el horario seleccionado.";
        }
        
        return $resultado;
    }
}