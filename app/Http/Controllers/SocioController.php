<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Model\Socio;
use App\Model\Tiposocio;
use App\Model\Servicio;


class SocioController extends Controller{

	
	public function listado(){

		$socio=Socio::join('tiposocio','tiposocio.idtiposocio','=','socio.idtiposocio')
					->select(
						'socio.idsocio'
						,'socio.nombre'
						,'socio.foto'
						,'tiposocio.idtiposocio'
						,'tiposocio.nombre as nombretiposocio'
					)
					->get();
		$datos=array();
		$datos['lista']=$socio;
		
		return view('socio.listado')->with($datos);
	}

	public function formulario(Request $r){
		$tiposocio=Tiposocio::all();
		$datos=array();
		$datos=$r->all();



		if($r->isMethod('post')){

			$operacion='Agregar';
			$socio=new Socio();
		}
		else{

			$operacion='Editar';
			$socio=Socio::find($datos['idsocio']);
		}

		
		$informacion=array();
		$informacion['operacion']=$operacion;
		$informacion['socio']=$socio;
		$informacion['tiposocios']=$tiposocio;

		
		
		return view('socio.formulario')->with($informacion);
	}


	public function save(Request $r){

		$datos=$r->all();
    	
		switch ($datos['operacion']) {
			case 'Agregar':
			if($r->hasfile('foto')){
				$archivo=$r->file('foto');
			
				$nombre='foto'.time().'.'.$archivo->getClientOriginalExtension();
			
				$nombre_archivo=$archivo->storeAs('fotosocio', $nombre);
			}
			else{
				$nombre_archivo='';
			}
			$socio=new socio();
			
			Storage::delete($socio->foto);
			$socio->nombre=$datos['nombre'];
			$socio->idtiposocio=$datos['idtiposocio'];
			
			$socio->foto=$nombre_archivo;
			$socio->save();

			break;
			case 'Editar':
    			
			if($r->hasfile('foto')){
				$archivo=$r->file('foto');

				$nombre='foto'.time().'.'.$archivo->getClientOriginalExtension();
				
				$nombre_archivo=$archivo->storeAs('fotosocio', $nombre);
			}
			else{
				$nombre_archivo='';
			}
			$socio=Socio::find($datos['idsocio']);
		
			if($nombre_archivo!=''){
				Storage::delete($socio->foto);
				$socio->foto=$nombre_archivo;
			}
			$socio->nombre=$datos['nombre'];
			$socio->idtiposocio=$datos['idtiposocio'];
			if($nombre_archivo!='')
				$socio->foto=$nombre_archivo;
			$socio->save();

			
			$socio->save();

			break;
			case 'eliminar':
    			
			$socio=Socio::find($datos['idsocio']);
			$socio->delete();
			Storage::delete($socio->foto);
			break;


		}
		return $this->listado();
	}
	public function mostrar_foto($nombre_foto){
		
		$path = storage_path('app/fotosocio/'.$nombre_foto);

		if(!file::exists($path)){
			abort(404);
		}

		$file = File::get($path);
		$type = File::mimeType($path);
		$response = Response::make($file, 200);
		$response -> header("Content-Type", $type);
		return $response;

	}
	public function perfil(){
		$usuario=auth()->user();
		$socio=Socio::where('idusuario',$usuario->idusuario)->first();
		
		$informacion['socio']=$socio;
		$informacion['tiposocio']=Tiposocio::find($socio->idtiposocio);
		$informacion['usuario']=$usuario;
		$informacion['servicio']=Servicio::where('idsocio',$socio->idsocio)->get();
		
		return view('login.listado')->with($informacion);
		
    }

}




