@extends('app.blank')
@section('titulo')
listado rentas de {{$socio->nombre}}
@endsection
@section('contenido')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="{{action('RentaController@formulario')}}" method="POST">
          {{csrf_field()}}
          <input type="hidden" value="{{$socio->idsocio}}" name="idsocio"  class="form-control">
          <button class="btn btn-success">Agregar</button>
        </form>
      </div>
    </div>
    <div id="app" class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <h1>Catalogo de Rentas</h1>
        <table class="table">
          <tr>
            <th>fecha inicio</th>
            <th>fecha fin</th>
            <th>precio</th>
          </tr>
          <tr v-for="elemento in renta">
            <td><a :href="url_editar+'?idrenta='+elemento.idrenta">@{{elemento.fechainicio}}</a></td>
            <td>@{{elemento.fechafin}}</td>
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
        renta:<?php echo json_encode($lista);?>
        ,url_editar:'{{action("RentaController@formulario")}}'

      }
      ,methods:{}
    });
  </script>
@endsection