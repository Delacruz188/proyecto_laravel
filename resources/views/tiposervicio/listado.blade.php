@extends('app.blank')
@section('titulo')
Catalogo de Tipos de servicios
@endsection
@section('contenido')
<div id="app" class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
      <h1></h1>
      <table class="table">
        <tr>          
          <th>Tipo de Servicio</th>
          <th>Materias primas requeridas</th>
        </tr>
        <tr v-for="elemento in lista">
          <td>@{{elemento.nombre}}</a></td>
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
@endsection