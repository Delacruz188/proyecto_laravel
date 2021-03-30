@extends('app.Blanck')
@section('titulo')
Catalogo de Servicios
@endsection
@section('contenido')
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <h1>¡Qué tal! {{$usuario}}</h1>
        <table class="table">
          <tr>
            <th>Cliente</th>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Tipo de Servicio</th>
          </tr>
          @foreach($lista as $elemento)
          <tr>
            <td>{{$elemento->nombre}}</td>
            <td>{{$elemento->placa}}</td>
            <td>{{$elemento->modelo}}</td>
            <td>{{$elemento->anio}}</td>
            <td>{{$elemento->tiposervicio}}</td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
  <script src="{{asset('public/jquery.min.js')}}"></script>
  <script src="{{asset('public/bootstrap.min.js')}}"></script>
  @endsection