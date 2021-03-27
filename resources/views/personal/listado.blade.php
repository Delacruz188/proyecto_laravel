@extends('app.Blanck')
@section('titulo')
Listado Personal
@endsection
@section('contenido')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="{{action('PersonalController@formulario')}}" method="POST">
          {{csrf_field()}}
          <button class="btn btn-success">Agregar</button>
        </form>
      </div>
    </div>
    <div id="app" class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <h1>Catalogo de personales</h1>
        <table class="table">
          <tr>
            <th>nombre</th>
            <th>curp</th>
            <th>foto</th>
          </tr>
          <tr v-for="elemento in lista">
            <td><a :href="url_editar+'?idpersonal='+elemento.idpersonal">@{{elemento.nombre}}</a></td>
            <td>@{{elemento.curp}}</td>
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
        ,url_editar:'{{action("PersonalController@formulario")}}'

      }
      ,methods:{}
    });

  </script>
@endsection
