<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;


class MostrarController extends Controller{

	
	public function perfil(){
		dd(auth()->user());
		return view('login.listado');
    }
}