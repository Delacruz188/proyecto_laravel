@extends('app.blank')
@section('titulo')
Formulario de materias primas
@endsection
@section('contenido')
  <div class="container">
    <div id="app" class="row">
      <form action="{{action('MateriaprimaController@save')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="idtiposervicio" class="form-control" :value="idtiposervicio">
       <table>
       <tr v-for="elemento in materias">
        <td  >
          <input type="checkbox" :checked="elemento.asignada" name="idmateriaprima[]" :value="elemento.idmateriaprima" >@{{elemento.nombre}}
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
        idtiposervicio:'{{$Tipo_materia->idtiposervicio}}'
        ,bandera:0
        ,mensaje:''
        ,materias:<?php echo json_encode($materias);?>

      }
      ,methods:{
        
      }
    });
</script>
@endsection