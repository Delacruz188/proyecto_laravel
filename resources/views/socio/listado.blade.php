
@extends('app.Blanck')
@section('titulo')
Socios
@endsection
@section('contenido')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="{{action('SocioController@formulario')}}" method="POST">
          {{csrf_field()}}
          <button class="btn btn-success">Agregar</button>
        </form>
      </div>
    </div>
    <div id="app" class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <h1>Catalogo de Socios</h1>
        <table class="table">
          <tr>
            <th>nombre</th>
            <th>tipo</th>
            <th>renta</th>     
            <th>foto</th>
          </tr>
          <tr v-for="elemento in lista">
            <td><a :href="url_editar+'?idsocio='+elemento.idsocio">@{{elemento.nombre}}</a></td>
            <td>@{{elemento.nombretiposocio}}</td>
            <td> <a :href="url_rentas+'?idsocio='+elemento.idsocio">rentas</a></td>
            <td>
              <img :src="'{{URL::to('/')}}/'+elemento.foto" width="100">
            </td>
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
        ,url_editar:'{{action("SocioController@formulario")}}'
        ,url_rentas:'{{action("RentaController@listado")}}'

      }
      ,methods:{}
    });

  </script>
@endsection
