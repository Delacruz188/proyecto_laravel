<?php
namespace App\BusinessLogic;
Use App\model\LogCheckout;

class BoLogCheckout{
    function registrar($objeto){
        $log = new LogCheckout();
        $log->idservicio = $objeto->idservicio;
        $log->fecha = date('Y-m-d H:i:s');
        if (isset($objeto->pasarela)) {
            $log->pasarela = $objeto->pasarela;
        }else{
            $log->pasarela = 'stripe';

        }
        $log->json=$objeto->json;
        $log->save();
    }
}