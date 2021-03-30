@extends('app.Blanck')
@section('titulo')
Catálogo de Roles en la empresa
@endsection
@section('contenido')
<div id="app" class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
      <table class="table">
        <tr>          
          <th>Rol</th>
          <th>Accesos</th>     

        </tr>
        <tr v-for="elemento in lista">
          <td>@{{elemento.nombre}}</td>
          <td><a :href="url_rol+'?idrol='+elemento.idrol">Acceso</a></td>
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
      ,url_rol:'{{action("PermisoController@formulario")}}'

    }
    ,methods:{}
  });

</script>
@endsection