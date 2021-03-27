<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Personal;
use App\Model\Socio;
use App\Model\Tiposocio;
use App\Model\Servicio;
use App\Model\Sucursal;
use App\Model\Tiposervicio;
use App\Model\Horario;
use App\Model\Estacion;
use App\BusinessLogic\BoServicio;
use Faker\Factory as Faker;


class DbUpController extends Controller{
	public function Personal(){
		$faker = Faker::create();
		$sucursales=Sucursal::all();
		for($i=1;$i<=50;$i++){
			$personal=new Personal();
			$personal->nombre=$faker->name.''.$faker->lastname;
			$personal->curp=$faker->regexify('([A-Z]){10}');
			$personal->foto='';
			$personal->idsucursal=$sucursales->random()->idsucursal;
			$personal->save();
		}

	}

	public function socio(){
		$faker = Faker::create();
		$Tiposocio=Tiposocio::all();
		for($i=1;$i<=50;$i++){
			$socio=new Socio();
			$socio->nombre=$faker->name.''.$faker->lastname;
			$socio->idtiposocio=$Tiposocio->random()->idtiposocio;
			$socio->save();
		}

	}

	
	public function fecha(){
		$faker = Faker::create();
		$servicio=servicio::all();
		foreach($servicio as $i){
			$i->fecharegistro=$faker->dateTimeBetween($starDate = '-4 month',$sendDate = 'now');
			$diadif=$faker->numberBetween(1,5);
			$i->fechareservacion=date('Y-m-d',strtotime($i->fecharegistro->format('Y-m-d')."+".$diadif."day"));
			$i->save();
		}
		

	}
	public function servicio_bo(){
		$boservicio=new BoServicio();
		$faker = Faker::create();
		$modelos=array('Nissan', 'Gol', 'Ford','Sentra');
		$tipos=Tiposervicio::all();
		$personales=Personal::all();
		$origenes=array('WEB', 'LOCAL', 'APP');
		$socio=Socio::all();
		$estaciones=Estacion::all();
		$horarios=Horario::all();
		$contador=1;
		while ($contador<=100) {
			$x=new \StdClass();
			$x->idsocio=$socio->random()->idsocio;
			$x->idtiposervicio=$tipos->random()->idtiposervicio;
			$x->idpersonal=$personales->random()->idpersonal;
			$x->placa=$faker->regexify('Y([A-Z0-9]){2}-([0-9]){4}');;
			$x->modelo=$faker->randomElement($modelos);;
			$x->anio=$faker->numberBetween(2018,2020);
			$x->origen=$faker->randomElement($origenes);;
			$x->idestacion=$estaciones->random()->idestacion;
			$x->idhorario=$horarios->random()->idhorario;
			$x->fecharegistro=$faker->dateTimeBetween($starDate = '-4 month',$endDate = 'now');
			$diadif=$faker->numberBetween(1,5);
			$x->fechaservicio=date('Y-m-d',strtotime($x->fecharegistro->format('Y-m-d')." + ".$diadif." day"));
			$y=$boservicio->registrar_servicio($x);
			if ($y->status=="OK") {
				$contador++;
			}
		}

	}
}

 
 
