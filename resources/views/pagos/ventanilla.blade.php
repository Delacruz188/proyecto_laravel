@extends('app.Blanck')
@section('titulo')
  Pagos
@endsection
@section('contenido')
  <div class="card">
    <div class="card-body">
      <form action="{{action('PagoController@ventanilla')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
          <label>Numero del servicio</label>
          <input type="int" name="idservicio" value="{{$idservicio}}" placeholder="Escribe el numero del servicio" class="form-control"></input>
        </div>
        <button class="btn btn-success" type="submit">buscar</button>
      </form>
      @if(isset($servicio))
      <br>
      <form action="#">
      <div class="form-group row">
        <div class="col-md-4">
          <label for="">Socio</label>
          <input type="text" value="{{$servicio->cliente}}" readonly class="form-control">
        </div>
        <div class="col-md-4">
          <label for="">Tipo servicio</label>
          <input type="text" value="{{$servicio->tipo}}" readonly class="form-control">
        </div>
        <div class="col-md-4">
          <label for="">Fecha atencion</label>
          <input type="text" value="{{$servicio->fecha_atencion_inicial}}" readonly class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-3">
          <label for="">Estacin</label>
          <input type="text" value="{{$servicio->nomestacion}}" readonly class="form-control">
        </div>
        <div class="col-md-3">
          <label for="">Placa</label>
          <input type="text" value="{{$servicio->placa}}" readonly class="form-control">
        </div>
        <div class="col-md-3">
          <label for="">Modelo</label>
          <input type="text" value="{{$servicio->modelo}}" readonly class="form-control">
        </div>
        <div class="col-md-3">
          <label for="">Año</label>
          <input type="text" value="{{$servicio->anio}}" readonly class="form-control">
        </div>
      </div>
      <div class="row">
        <h3>Total:{{$servicio->precio}}</h3>
      </div>
        
      </form>
      @endif
    </div>
    <div id="app"></div>
  </div>
  
  <script src="{{asset('public/jquery.min.js')}}"></script>
  <script src="{{asset('public/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/vue.js')}}"></script>
  @if(isset($servicio))
  <script src="https://js.stripe.com/v2/"></script>
  
  <script>
  var llave_publica='pk_test_51IaPa4D4ypF0DVYh45kxPeiDogipfZsM8JmqkzseaUnXr25lmHK6UiQekxW9Sa5s4kR2bAtDkEzvV4k7HQTIYbm000hmsdDwo6';
  var servicio={{$idservicio}};
  var laravel_token='{{csrf_token()}}';
  var url_pago='{{action('PagoController@realizar_pago')}}'
  
  </script>
  <script src="{{asset('public/payment/build.js')}}"></script>

  @endif

  
@endsection