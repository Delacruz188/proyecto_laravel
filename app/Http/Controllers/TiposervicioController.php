<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Tiposervicio;

class TiposervicioController extends Controller{

	
	public function listado(){
		$Tiposervicios=Tiposervicio::all();
		$datos=array();
		$datos['lista']=$Tiposervicios;
		
		return view('tiposervicio.listado')->with($datos);
	}

	public function formulario(Request $r){
	
		$datos=$r->all();

		


	
		if($r->isMethod('post')){
	
			$operacion='Agregar';
			$tiposervicio=new Tiposervicio();
		}
		else{

			$operacion='Editar';
			$tiposervicio=Tiposervicio::find($datos['idtiposervicio']);
		}
		
		
		$informacion=array();
		$informacion['operacion']=$operacion;
		$informacion['tiposervicio']=$tiposervicio;

		
		
		return view('tiposervicio.formulario')->with($informacion);
	}
    

    public function save(Request $r){
	
    	$datos=$r->all();
    	
    	switch ($datos['operacion']) {
    		case 'Agregar':
    			$tiposervicio=new Tiposervicio();
    			$tiposervicio->nombre=$datos['nombre'];
    			$tiposervicio->servicio=$datos['servicio'];
    			
    			$tiposervicio->save();
	
    		break;
    		case 'Editar':
    			
    			$tiposervicio=Tiposervicio::find($datos['idtiposervicio']);
    			$tiposervicio->nombre=$datos['nombre'];
    			$tiposervicio->servicio=$datos['servicio'];
    			
    			
    			$tiposervicio->save();
    				
    		break;
    		case 'eliminar':
    			
    			$tiposervicio=tiposervicio::find($datos['idtiposervicio']);
    			$tiposervicio->delete();
    		break;
   
    		
    	}
    		return $this->listado();
    }

    	
    }

		
	

