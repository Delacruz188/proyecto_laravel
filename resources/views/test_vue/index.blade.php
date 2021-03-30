@extends('app.blank')
@section('titulo')
Calendario de Servicios
@endsection
@section('contenido')
    <div id="app">
      <form name="frm" action="{{action('DemoController@prueba_vue')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="fecha" id="oculto">
      </form>
      <script src="{{asset('public/jquery.min.js')}}"></script>
      <script src="{{asset('public/bootstrap.min.js')}}"></script>
    </div>
    <script>  
     var columnas_iniciales = <?php echo json_encode($estaciones)?>;
     var filas_iniciales = <?php echo json_encode($horarios)?>;
     var asignaciones_iniciales = <?php echo json_encode($asignaciones)?>;
     var lista_socios = <?php echo json_encode($socios)?>;
     var lista_tipos = <?php echo json_encode($tipos)?>;
     var bandera_sincrono = false;
     var url_envio = '{{action('DemoController@prueba_axios')}}';
     var url_envio2 = '{{action('DemoController@insertar_datos')}}';
     var tk = '{{csrf_token()}}';
     console.log(document.getElementById('oculto').value)
    </script>
    <script src="{{asset('public/TimeTable/build.js')}}"></script>
@endsection
