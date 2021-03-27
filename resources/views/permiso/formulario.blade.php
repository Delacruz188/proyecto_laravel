@extends('app.Blanck')
@section('titulo')
Formulario de materias primas
@endsection
@section('contenido')
  <div class="container">
    <div id="app" class="row">
      <form action="{{action('PermisoController@save')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="idrol" class="form-control" :value="idrol">
       <table>
       <tr v-for="elemento in permiso">
        <td  >
          <input type="checkbox" :checked="elemento.asignada" name="idpermiso[]" :value="elemento.idpermiso" >@{{elemento.nombre}}
        </td> 
      </tr>
       </table>
       <button type="submit" class="btn btn-success">listo</button>
      
      </form>
    </div>
  </div>
  <script src="{{asset('public/jquery.min.js')}}"></script>
  <script src="{{asset('public/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/vue.js')}}"></script>
  <script>
    new Vue({
      el:'#app',
      data:{
        idrol:'{{$rol_permiso->idrol}}'
        ,bandera:0
        ,mensaje:''
        ,permiso:<?php echo json_encode($permiso);?>

      }
      ,methods:{
        
      }
    });
</script>
@endsection