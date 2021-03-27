<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Rol;
use App\Model\Permiso;
use App\Model\Rol_permiso;



class PermisoController extends Controller{

	public function formulario(Request $r){
	
		$datos=$r->all();
			
		
		$rol_permiso=new Rol_permiso();
		$rol_permiso->idrol=$datos['idrol'];
		$asig=Rol_permiso::where('idrol',$datos['idrol'])->get();
		$permiso=Permiso::all();
		
		
		for ($i=0; $i < count($permiso); $i++) { 
			$bandera=false;
			foreach ($asig as $elemento) {
				
				if ($elemento->idpermiso==$permiso[$i]->idpermiso) {
					$bandera=true;
				}
				$permiso[$i]->asignada=$bandera;
			}
			
		}
		
		
		
		$informacion=array();
		
		$informacion['rol_permiso']=$rol_permiso;
		$informacion['permiso']=$permiso;
		
		
		
		

		
		
		return view('permiso.formulario')->with($informacion);
	}

	public function save(Request $r){

		$datos=$r->all();
		rol_permiso::where('idrol',$datos['idrol'])->delete();
		if(isset($datos['idpermiso'])){
			foreach($datos['idpermiso'] as $permisoo){
				$permiso=new rol_permiso();
				$permiso->idpermiso=$permisoo;
				$permiso->idrol=$datos['idrol'];
				$permiso->save();
				
			}
		}
		$Tiporol=Rol::all();
		$datos=array();
		$datos['lista']=$Tiporol;
		return view('tiporol.listado')->with($datos);
		
		
    	
		
			
    		
		
		
	}


}




