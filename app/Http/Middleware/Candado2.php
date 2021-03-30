<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Model\Permiso;
use App\Model\Rol_Permiso;

use Closure;
class Candado2
{
    public function handle($request, Closure $next,$permiso)
    {
    	
    	$idrol=Auth::user()->idrol;
    	$permiso=Permiso::where('clave',$permiso)->first();
    	$rolxpermiso=Rol_Permiso::where('idrol',$idrol)->where('idpermiso',$permiso->idpermiso)->first();

    	if($rolxpermiso){
    	return $next($request);	
    	}
    	else{
    		return response("No tienes permisos",401);    		
    	}        
    }
}