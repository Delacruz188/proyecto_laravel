<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\http\Request;
use App\BusinessLogic\BoServicio;
use App\Pagos\StripeProcessor;
use App\Model\Usuario;



class PagoController extends Controller{
	function ventanilla(Request $r){
        
        $datos=array();
		if($r->isMethod('post')){
            $context=$r->all();
            $bo=new BoServicio();
            $data=new \StdClass();
            $data->idservicio=$context['idservicio'];
            $datos['servicio']=$bo->obten_servicios($data)[0];
            $datos['idservicio']=$context['idservicio'];
        }
		else{
			
			
			$datos['idservicio']='';
		}
        
		return view('pagos.ventanilla')->with($datos);
    }
    function realizar_pago(Request $r){
        $context=$r->all();
        $bo=new BoServicio();
        $data=new \StdClass();
        $data->idservicio=$context['idservicio'];
        $servicio=$bo->obten_servicios($data)[0];
        $usuario = Usuario::find($servicio->idusuario);


        $stripe = new StripeProcessor();
        $objeto_pago = new \StdClass();
        $objeto_pago->amount = $servicio->precio*100;
        $objeto_pago->currency_code = 'MXN';
        $objeto_pago->producto = $servicio->tipo;
        $objeto_pago->email = $servicio->email;
        $objeto_pago->token = $context['token_stripe'];
        $objeto_pago->item_number = $context['idservicio'];
        $stripeResponse = $stripe->enviar_datos_pago($objeto_pago);
        if ($stripeResponse->status=='OK') {
            $objeto_status = new \StdClass();
            $objeto_status->idservicio = $context['idservicio'];
            $res_status = $bo->pagar_servicio($objeto_status);
        }
        return response()->json($stripeResponse);

    }


}