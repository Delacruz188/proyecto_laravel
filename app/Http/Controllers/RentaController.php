<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Renta;
use App\Model\Socio;

class RentaController extends Controller{

	
	public function listado(Request $r){
		$context=$r->all();
		$datos=array();
		$socio=Socio::find($context['idsocio']);
		$renta=Renta::where('idsocio',$context['idsocio'])->get();
		$datos['socio']=$socio;	
		$datos['lista']=$renta;	

		
		
		return view('renta.listado')->with($datos);
	}

	public function formulario(Request $r){
	
		$datos=$r->all();

	


		if($r->isMethod('post')){
			
			$operacion='Agregar';
			$renta=new Renta();
			$renta->idsocio=$datos['idsocio'];
		}
		else{
			
			$operacion='Editar';
			$renta=Renta::find($datos['idrenta']);
			
		}
		

		$informacion=array();
		$informacion['operacion']=$operacion;
		$informacion['renta']=$renta;
		
		

		
		
		return view('renta.formulario')->with($informacion);
	}

	public function save(Request $r){

		$datos=$r->all();
    	
		switch ($datos['operacion']) {
			case 'Agregar':
			$renta=new Renta();
			$renta->fechainicio=$datos['fechainicio'];
			$renta->fechafin=$datos['fechafin'];
			$renta->idsocio=$datos['idsocio'];
			$renta->precio=$datos['precio'];
			
			$renta->save();

			break;
			case 'Editar':
    		
			$renta=Renta::find($datos['idrenta']);
			$renta->fechainicio=$datos['fechainicio'];
			$renta->fechafin=$datos['fechafin'];
			$renta->idsocio=$datos['idsocio'];
			$renta->precio=$datos['precio'];
			
			$renta->save();

			break;
			case 'eliminar':
    	
			$renta=Renta::find($datos['idrenta']);
			$renta->delete();
			break;
    		
		}
		return $this->listado($r);
	}


}




