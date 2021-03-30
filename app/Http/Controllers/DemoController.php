<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\BusinessLogic\BoServicio;
use App\Model\Socio;
use App\Model\Tiposervicio;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionServicio;

class DemoController extends Controller{

	public function prueba_vue(Request $r){
		$datos=array();
		$datos['horarios']=array();
		$datos['horarios'][]=array("id"=>1,"label"=>"10:00 am");
		$datos['horarios'][]=array("id"=>2,"label"=>"11:00 am");
		$datos['horarios'][]=array("id"=>3,"label"=>"12:00 am");
		$datos['horarios'][]=array("id"=>4,"label"=>"13:00 pm");
		$datos['horarios'][]=array("id"=>5,"label"=>"14:00 pm");
		$datos['horarios'][]=array("id"=>6,"label"=>"15:00 pm");

		$datos['estaciones']=array();
		$datos['estaciones'][]=array("id"=>1,"label"=>"Norte");
		$datos['estaciones'][]=array("id"=>2,"label"=>"Sur");
		$datos['estaciones'][]=array("id"=>3,"label"=>"Este");
		$datos['estaciones'][]=array("id"=>4,"label"=>"Oeste");


		$datos['asignaciones']=array();
		if($r->isMethod('post')){
			$datos['asignaciones'][]=array("fila"=>1,"columna"=>1,"cliente"=>"Nicolas","tipo"=>"Normal");
			$datos['asignaciones'][]=array("fila"=>2,"columna"=>2,"cliente"=>"Jorge","tipo"=>"Premium");
			$datos['asignaciones'][]=array("fila"=>3,"columna"=>3,"cliente"=>"Paco","tipo"=>"VIP");
			$datos['asignaciones'][]=array("fila"=>2,"columna"=>2,"cliente"=>"Jorge","tipo"=>"Ultra VIP");

		}else{
			$boservicio=new BoServicio();
			$objeto=new \StdClass();
			$objeto->fecha=date('Y-m-d');
			$datos['asignaciones']=$boservicio->obten_servicios($objeto);
		}
		$datos['socios']=Socio::all();
		$datos['tipos']=Tiposervicio::all();
		return view('test_vue.index')->with($datos);
	}
	public function prueba_axios(Request $r){
		$context=$r->all();
		$boservicio=new BoServicio();
		$objeto=new \StdClass();
		$objeto->fecha=$context['fecha'];
		return response()->json($boservicio->obten_servicios($objeto));
	}
	public function insertar_datos(Request $r){
		$context=$r->all();
		$x=$this->prueba_bo($context);
		return response()->json($x);
	}		
	public function prueba_bo($data){
		$boservicio=new BoServicio();
		$x=new \StdClass();
		$x->idsocio=$data['servicio']['socio'];
		$x->idtiposervicio=$data['servicio']['idtipo'];
		$x->curp=$data['servicio']['personal'];
		$x->placa=$data['servicio']['placa'];
		$x->modelo=$data['servicio']['modelo'];
		$x->anio=$data['servicio']['anio'];
		$x->origen='WEB';
		$x->idestacion=$data['servicio']['columna'];
		$x->idhorario=$data['servicio']['fila'];
		$x->fechaservicio=$data['servicio']['fecha'];
		$y=$boservicio->registrar_servicio($x);
		if ($y->status=='OK') {
            $datos= new \StdClass();
			$datos->num_servicio=$y->servicio->idservicio;
			$datos->fecha_servicio=$y->servicio->fecha_atencion_inicial;
			$datos->cliente=$y->cliente;
			$datos->tipo_servicio=$y->tipo;
			$datos->total=$y->servicio->precio;
			Mail::to($y->email)->send(new ConfirmacionServicio($datos));
        }
		return $y;	
	}	

	public function envio_email()
	{
		$datos= new \StdClass();
		$datos->num_servicio='2487';
		$datos->fecha_servicio='09 de Marzo';
		$datos->cliente='Carlos';
		$datos->tipo_servicio='Premium';
		$datos->total=200;
		Mail::to('delacruzc410@gmail.com')->send(new ConfirmacionServicio($datos));
	}
	
    


 
 
}