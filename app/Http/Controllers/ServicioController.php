<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Servicio;
use App\Model\Personal;
use App\Model\Tiposervicio;
use App\Model\Socio;

class ServicioController extends Controller{

	
	public function listado(){
		$servicio=Servicio::all();
		$datos=array();
		$datos['lista']=$servicio;
		$datos['usuario']='Carlos De la Cruz';
		return view('servicio.listado')->with($datos);
	}

	public function formulario(){
		$informacion['socios']=Socio::all();
		$informacion['personales']=Personal::all();
		$informacion['tiposservicio']=Tiposervicio::all();
		return view('servicio.formulario');
	}
    
    public function save(Request $r){
		dd($r);
		
		$datos=$r->all();
		
		$servicio=new Servicio();
		// $servicio->nombre=$datos['cliente'];
		$servicio->placa=$datos['placa'];
		$servicio->modelo=$datos['modelo'];
		$servicio->ano=$datos['ano'];
		$servicio->tiposervicio=$datos['tiposervicio'];
		$servicio->save();
		return $this->listado();
	}


 
 
}