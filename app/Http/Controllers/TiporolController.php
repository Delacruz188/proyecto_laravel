<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Rol;

class TiporolController extends Controller{

	
	public function listado(){
		$Tiporol=Rol::all();
		$datos=array();
		$datos['lista']=$Tiporol;
		
		return view('tiporol.listado')->with($datos);
	}

	

    	
    }

		
	

