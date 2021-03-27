<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Renta;
use App\Model\Socio;
use App\Model\Tipo_materia;
use App\Model\Materiaprima;
use App\Model\Tiposervicio;



class MateriaprimaController extends Controller{

	public function formulario(Request $r){
	
		$datos=$r->all();
			
		
		$Tipo_materia=new Tipo_materia();
		$Tipo_materia->idtiposervicio=$datos['idtiposervicio'];
		$asig=Tipo_materia::where('idtiposervicio',$datos['idtiposervicio'])->get();
		$materias=Materiaprima::all();
		
		for ($i=0; $i < count($materias); $i++) { 
			$bandera=false;
			foreach ($asig as $elemento) {
				if ($elemento->idmateriaprima==$materias[$i]->idmateriaprima) {
					$bandera=true;
				}
				$materias[$i]->asignada=$bandera;
			}
			
		}
		
		
		$informacion=array();
		
		$informacion['Tipo_materia']=$Tipo_materia;
		$informacion['materias']=$materias;
		
		
		
		

		
		
		return view('materiaprima.formulario')->with($informacion);
	}

	public function save(Request $r){

		$datos=$r->all();
		Tipo_materia::where('idtiposervicio',$datos['idtiposervicio'])->delete();
		if(isset($datos['idmateriaprima'])){
			foreach($datos['idmateriaprima'] as $materiaa){
				$materia=new Tipo_materia();
				$materia->idmateriaprima=$materiaa;
				$materia->idtiposervicio=$datos['idtiposervicio'];
				$materia->save();
				
			}
		}
		$Tiposervicios=Tiposervicio::all();
		$datos=array();
		$datos['lista']=$Tiposervicios;
		return view('tiposervicio.listado')->with($datos);
		
		
    	
		
			
    		
		
		
	}


}




