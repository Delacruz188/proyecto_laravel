<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Model\Personal;


class PersonalController extends Controller{

	
	public function listado(){
		$personales=Personal::all();
		$datos=array();
		$datos['lista']=$personales;
		
		return view('personal.listado')->with($datos);
	}

	public function formulario(Request $r){

		$datos=$r->all();



		if($r->isMethod('post')){

			$operacion='Agregar';
			$personal=new Personal();
		}
		else{

			$operacion='Editar';
			$personal=Personal::find($datos['idpersonal']);
		}

		
		$informacion=array();
		$informacion['operacion']=$operacion;
		$informacion['personal']=$personal;

		
		
		return view('personal.formulario')->with($informacion);
	}


	public function save(Request $r){

		$datos=$r->all();
    	
		switch ($datos['operacion']) {
			case 'Agregar':
			if($r->hasfile('foto')){
				$archivo=$r->file('foto');
			
				$nombre='foto'.time().'.'.$archivo->getClientOriginalExtension();
			
				$nombre_archivo=$archivo->storeAs('foto', $nombre);
			}
			else{
				$nombre_archivo='';
			}
			$personal=new Personal();
			
			Storage::delete($personal->foto);
			$personal->nombre=$datos['nombre'];
			$personal->curp=$datos['curp'];
			$personal->idsucursal=$datos['sucursal'];
			
			$personal->foto=$nombre_archivo;
			$personal->save();

			break;
			case 'Editar':
    			
			if($r->hasfile('foto')){
				$archivo=$r->file('foto');

				$nombre='foto'.time().'.'.$archivo->getClientOriginalExtension();
				
				$nombre_archivo=$archivo->storeAs('foto', $nombre);
			}
			else{
				$nombre_archivo='';
			}
			$personal=Personal::find($datos['idpersonal']);
		
			if($nombre_archivo!=''){
				Storage::delete($personal->foto);
				$personal->foto=$nombre_archivo;
			}
			$personal->nombre=$datos['nombre'];
			$personal->idsucursal=$datos['sucursal'];
			$personal->curp=$datos['curp'];
			if($nombre_archivo!='')
				$personal->foto=$nombre_archivo;
			$personal->save();

			
			$personal->save();

			break;
			case 'eliminar':
    			
			$personal=Personal::find($datos['idpersonal']);
			$personal->delete();
			Storage::delete($personal->foto);
			break;


		}
		return $this->listado();
	}
	public function mostrar_foto($nombre_foto){
		
		$path = storage_path('app/foto/'.$nombre_foto);

		if(!file::exists($path)){
			abort(404);
		}

		$file = File::get($path);
		$type = File::mimeType($path);
		$response = Response::make($file, 200);
		$response -> header("Content-Type", $type);
		return $response;

	}

}




