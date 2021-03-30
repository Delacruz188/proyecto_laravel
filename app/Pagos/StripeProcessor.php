<?php
namespace App\Pagos;
require_once 'Stripe/init.php';
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\ApiOperations\Create;
use Stripe\Charge;
use Stripe\HttpClient\CurlClient;
use Stripe\ApiRequestor;

use App\BusinessLogic\BoLogCheckout;

class StripeProcessor
{
    var $objeto_stripe;

    public function __construct()
    {
        
        $curl = new CurlClient([CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2]);
        ApiRequestor::setHttpClient($curl);
        $this->objeto_stripe = new Stripe();
        $this->objeto_stripe->setVerifySslCerts(false);
        $this->objeto_stripe->setApiKey('sk_test_51IaPa4D4ypF0DVYhBAqvUqVEQqowJegYdTJoXyzf7Ck0KNB18f6lkmoJ6lH9A0k7iVwnHwhwGJrm6aKYMq8OJfx800LKWuer8E');
    }

    public function crear_customer($objeto)
    {
        $customer = new Customer();
        $datos_customer = array();
        $datos_customer['email'] =  $objeto->email;
        $datos_customer['source'] = $objeto->token;
        $customerDetails = $customer->create($datos_customer);
        return $customerDetails;
    }

    public function enviar_datos_pago($objeto)
    {
        $customerResult = $this->crear_customer($objeto);
        $cargo = new Charge();
        $cardDetailsAry = array(
            'customer' => $customerResult->id,
            'amount' => $objeto->amount,
            'currency' => $objeto->currency_code,
            'description' => $objeto->producto,
            'metadata' => array(
                'order_id' => $objeto->item_number
            )
        );
        $result = $cargo->create($cardDetailsAry);
        $obj_result = $result->jsonSerialize();
        $resultado = new \StdClass();
        if (($obj_result['amount_refunded']==0) && (empty($obj_result['failure_code'])) && ($obj_result['paid']) && ($obj_result['captured']) && ($obj_result['status']=='succeeded')) {
            $resultado->status = 'OK';
            $resultado->transaccion = $obj_result;
        }else{
            $resultado->status = 'ERROR';
            $resultado->transaccion = null;
        }
         $bo = new BoLogCheckout();
         $objeto_log = new \StdClass();
         $objeto_log->idservicio = $objeto->item_number;
         $objeto_log->json = json_encode($obj_result);
         $bo->registrar($objeto_log);

        return $resultado;
    }
    

}
