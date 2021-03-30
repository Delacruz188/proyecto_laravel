<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\http\Request;
use App\Model\Servicio;
use App\Model\Personal;
use App\Model\Tiposervicio;
use App\Model\Socio;


class BuscadorController extends Controller{
	public function formulario(){
		$informacion['socios']=Socio::all();
		$informacion['personales']=Personal::all();
		$informacion['tiposservicio']=Tiposervicio::all();
		
		return view('servicio.formulario')->with($informacion);
	}
	public function save(Request $r){
		$datos=$r->all();
		date_default_timezone_set("America/Merida");
		
		
		$servicio=new Servicio();
		$servicio->fecharegistro=date('Y-m-d H:i:s');
		$servicio->fechareservacion=$datos['fechareservacion'];
		$servicio->idsocio=$datos['idsocio'];
		$servicio->idpersonal=$datos['idpersonal'];
		$servicio->placa=$datos['placa'];
		$servicio->modelo=$datos['modelo'];
		$servicio->anio=$datos['ano'];
		$servicio->idtiposervicio=$datos['idtiposervicio'];
		$tiposervicio=Tiposervicio::find($datos['idtiposervicio']);
		$servicio->precio=$tiposervicio->precio;
		$servicio->save();
		return $this->formulario();
	}
	function index(Request $r){
		$context=$r->all();
		if($r->isMethod('post')){
			
		$registros=DB::table('servicio')
					->join('personal','servicio.idpersonal','=','personal.idpersonal')
					->join('tiposervicio','servicio.idtiposervicio','=','tiposervicio.idtiposervicio')
					->join('socio','servicio.idsocio','=','socio.idsocio')
					->join('tiposocio','socio.idtiposocio','=','tiposocio.idtiposocio')
					->select(
							'placa'
							,'modelo'
							,'anio'
							,'servicio.precio'
							,DB::Raw('tiposervicio.nombre as tiposervicio')
							,DB::Raw('personal.nombre as personal')
							,DB::Raw('tiposocio.nombre as tiposocio')
							,DB::Raw('socio.nombre as socio')
							,\DB::Raw("DATE_FORMAT(fecharegistro, '%Y-%m-%d') as fecharegistro")
							,\DB::Raw("DATE_FORMAT(fecha_atencion_final, '%Y-%m-%d') as fechareservacion")
						)
					->whereRaw("placa like '%".$context['criterio']."%' or personal.nombre like'%".$context['criterio']."%' or socio.nombre like'%".$context['criterio']."%'")
					->get();
		$datos=array();
		$datos['registros']=$registros;
		$datos['criterio']=$context['criterio'];
		;
		}
		else{
			$datos=array();
			$datos['registros']=array();
			$datos['criterio']='';
		}
		
		return view('Buscador.index')->with($datos);
	}


}