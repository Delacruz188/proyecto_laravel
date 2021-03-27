<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods. POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
   //administrador rutas de permisos
   Route::get('/catalogos/tiporol/listado','TiporolController@listado')->middleware('candado:PERMISOS');
   Route::match(array('GET','POST'),'/catalogos/Tiporol/formulario','TiporolController@formulario')->middleware('candado:PERMISOS');
   Route::post('/catalogos/tiporol/save','TiporolController@save')->middleware('candado:PERMISOS'); 
   Route::match(array('GET','POST'),'/catalogos/permiso/listado','PermisoController@listado')->middleware('candado:PERMISOS');
   Route::match(array('GET','POST'),'/catalogos/permiso/formulario','PermisoController@formulario')->middleware('candado:PERMISOS');
   Route::post('/catalogos/permiso/save','PermisoController@save')->middleware('candado:PERMISOS');

   //administrador, personal rutas de sevicios y materiales
   Route::get('/catalogos/tiposervicio/listado','TiposervicioController@listado')->middleware('candado:SERVICIOS');
   Route::match(array('GET','POST'),'/catalogos/Tiposervicio/formulario','TiposervicioController@formulario')->middleware('candado:SERVICIOS');
   Route::post('/catalogos/tiposervicio/save','TiposervicioController@save')->middleware('candado:SERVICIOS'); 
   Route::match(array('GET','POST'),'/catalogos/materiaprima/listado','MateriaprimaController@listado')->middleware('candado:SERVICIOS');
   Route::match(array('GET','POST'),'/catalogos/materiaprima/formulario','MateriaprimaController@formulario')->middleware('candado:SERVICIOS');
   Route::post('/catalogos/materiaprima/save','MateriaprimaController@save')->middleware('candado:SERVICIOS');

   //administrador, socio, personaln rutas del buscador


   // Route::get('/catalogos/tiporol/listado','TiporolController@listado');
   // Route::match(array('GET','POST'),'/catalogos/Tiporol/formulario','TiporolController@formulario');
   // Route::post('/catalogos/tiporol/save','TiporolController@save'); 
   // Route::match(array('GET','POST'),'/catalogos/permiso/listado','PermisoController@listado');
   // Route::match(array('GET','POST'),'/catalogos/permiso/formulario','PermisoController@formulario');
   // Route::post('/catalogos/permiso/save','PermisoController@save');

   // //administrador, personal rutas de sevicios y materiales
   // Route::get('/catalogos/tiposervicio/listado','TiposervicioController@listado');
   // Route::match(array('GET','POST'),'/catalogos/Tiposervicio/formulario','TiposervicioController@formulario');
   // Route::post('/catalogos/tiposervicio/save','TiposervicioController@save'); 
   // Route::match(array('GET','POST'),'/catalogos/materiaprima/listado','MateriaprimaController@listado');
   // Route::match(array('GET','POST'),'/catalogos/materiaprima/formulario','MateriaprimaController@formulario');
   // Route::post('/catalogos/materiaprima/save','MateriaprimaController@save');

// }); 

   Route::match(array('GET','POST'),'/buscador','BuscadorController@index');

   //terceeeeeeeeeer parciaaaaaaaaaaaaal
   Route::get('/catalogos/servicios/listar','ServicioController@listar');
   Route::match(array('GET','POST'),'/servicio/registro','BuscadorController@formulario');
   Route::post('/servicio/save','BuscadorController@save');
   Route::get('/dbup/fecha','DbUpController@fecha');
   //terceeeeeeeeeer parciaaaaaaaaaaaaal 
 



   Route::get('/catalogos/personal/listado','PersonalController@listado');
   Route::match(array('GET','POST'),'/catalogos/personal/formulario','PersonalController@formulario');
   Route::post('/catalogos/personal/save','PersonalController@save');

   Route::get('/catalogos/socio/listado','SocioController@listado');
   Route::match(array('GET','POST'),'/catalogos/socio/formulario','SocioController@formulario');
   Route::post('/catalogos/socio/save','SocioController@save');


   Route::get('/catalogos/producto/listado','ProductoController@listado');
   Route::match(array('GET','POST'),'/catalogos/producto/formulario','ProductoController@formulario');
   Route::post('/catalogos/producto/save','ProductoController@save'); 

   Route::match(array('GET','POST'),'/catalogos/renta/listado','RentaController@listado');
   Route::match(array('GET','POST'),'/catalogos/renta/formulario','RentaController@formulario');
   Route::post('/catalogos/renta/save','RentaController@save');

   
    

   Route::get('foto/{nombre_foto}','PersonalController@mostrar_foto');
   Route::get('fotosocio/{nombre_foto}','SocioController@mostrar_foto');


   //Dbup
   Route::get('/dbup/personal','DbUpController@personal');
   Route::get('/dbup/servicio','DbUpController@servicio');
   Route::get('/dbup/socio','DbUpController@socio');
   
   //Dbup 

  
   
   Route::get('/welcome','SocioController@perfil' );
   
   Route::match(array('GET','POST'),'/RegisAdmin','Auth\RegisterController@formulario');
   Route::match(array('GET','POST'),'/RegisSave','Auth\RegisterController@register');

   Route::get('/RegisUser',function (){
      return view('login.register');
   });
   
   
   Route::get('/manage','Auth\LoginController@formulario')->name('login');
   // Route::get('/','Auth\LoginController@formulario');
   Route::post('/login','Auth\LoginController@login');

   Route::match(array('GET','POST'),'/test_vue','DemoController@prueba_vue');
   Route::post('/test_axios','DemoController@prueba_axios');
   Route::post('/test_insertar','DemoController@prueba_insertar');
   
   Route::match(array('GET','POST'),'/prueba_bo','DemoController@prueba_bo');
   Route::get('/dbup/prueba_bo','DbUpController@servicio_bo');


   Route::get('/test/email','DemoController@envio_email');
   Route::match(array('GET','POST'),'/pagos/ventanilla','PagoController@ventanilla');
   Route::post('/pagos/procesar','PagoController@realizar_pago');
   
   
   
 

