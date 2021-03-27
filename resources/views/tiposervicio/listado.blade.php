<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">  
    <title>catalogo de tiposervicio</title>
 
    
     
    <link rel="stylesheet" href="{{asset('public/bootstrap.css')}}">     
  </head>  
<body>
 
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        
      </div>
    </div>
    <div id="app" class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <h1>Catalogo de Tipos de servicios</h1>
        <table class="table">
          <tr>
            
            <th>tipo de servicio</th>
            <th>&nbsp:</th>     

          </tr>
          <tr v-for="elemento in lista">
            <td>>@{{elemento.nombre}}</a></td>
            <td><a :href="url_materia+'?idtiposervicio='+elemento.idtiposervicio">Materias primas</a></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <script src="{{asset('public/jquery.min.js')}}"></script>
  <script src="{{asset('public/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/vue.js')}}"></script>
  <script>  
    new Vue({
      el:'#app',
      data:{
        lista:<?php echo json_encode($lista);?>
        ,url_editar:'{{action("TiposervicioController@formulario")}}'
        ,url_materia:'{{action("MateriaprimaController@formulario")}}'

      }
      ,methods:{}
    });

  </script>
</body></html>