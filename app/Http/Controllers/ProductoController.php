<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Producto;

class ProductoController extends Controller{

	
	public function listado(){
		$productos=Producto::all();
		$datos=array();
		$datos['lista']=$productos;
		
		return view('producto.listado')->with($datos);
	}

	public function formulario(Request $r){
	
		$datos=$r->all();

	


		if($r->isMethod('post')){
			
			$operacion='Agregar';
			$producto=new Producto();
		}
		else{
			
			$operacion='Editar';
			$producto=Producto::find($datos['idproducto']);
		}
		
		$informacion=array();
		$informacion['operacion']=$operacion;
		$informacion['producto']=$producto;

		
		
		return view('producto.formulario')->with($informacion);
	}

	public function save(Request $r){

		$datos=$r->all();
    	
		switch ($datos['operacion']) {
			case 'Agregar':
			$producto=new Producto();
			$producto->nombre=$datos['nombre'];
			$producto->precio=$datos['precio'];
			
			$producto->save();

			break;
			case 'Editar':
    		
			$producto=Producto::find($datos['idproducto']);
			$producto->nombre=$datos['nombre'];
			$producto->precio=$datos['precio'];
			
			$producto->save();

			break;
			case 'eliminar':
    	
			$producto=Producto::find($datos['idproducto']);
			$producto->delete();
			break;
    		
		}
		return $this->listado();
	}


}




