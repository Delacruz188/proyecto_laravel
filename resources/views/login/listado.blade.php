@extends('app.blank')
@section('titulo')
Bienvenido {{$socio->nombre}}
@endsection
@section('contenido')
  <div class="container">
      <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white"
                   style="background: url('../dist/img/photo1.png') center center;">
                <h3 class="widget-user-username text-right">{{$socio->nombre}}</h3>
                <h5 class="widget-user-desc text-right">Web Designer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="../dist/img/user3-128x128.jpg" alt="{{$socio->nombre}}">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Socio</h5>
                      <span class="description-text">{{$tiposocio->nombre}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Servicios</h5>
                      <span class="description-text">{{count($servicio)}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">Email</h5>
                      <span class="description-text">{{$usuario->email}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
    

      <div class="col-md-12 col-xs-12 col-sm-12">
        <h1>Servicios</h1>
        <table class="table">
          <tr>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Precio</th>
          </tr>
          @foreach($servicio as $elemento)
          <tr >
            <td>{{$elemento->placa}}</td>
            <td>{{$elemento->modelo}}</td>
            <td>{{$elemento->precio}}</td>
          </tr>
          @endforeach
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
        

      }
      ,methods:{}
    });

  </script>
@endsection
