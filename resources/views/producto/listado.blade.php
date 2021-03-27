@extends('app.Blanck')
@section('titulo')
listado Productos
@endsection
@section('contenido')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="{{action('ProductoController@formulario')}}" method="POST">
          {{csrf_field()}}
          <button class="btn btn-success">Agregar</button>
        </form>
      </div>
    </div>
    <div id="app" class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <h1>Catalogo de Productos</h1>
        <table class="table">
          <tr>
            <th>nombre</th>
            <th>precio</th>
          </tr>
          <tr v-for="elemento in producto">
            <td><a :href="url_editar+'?idproducto='+elemento.idproducto">@{{elemento.nombre}}</a></td>
            <td>@{{elemento.precio}}</td>
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
        producto:<?php echo json_encode($lista);?>
        ,url_editar:'{{action("ProductoController@formulario")}}'

      }
      ,methods:{}
    });
  </script>
@endsection