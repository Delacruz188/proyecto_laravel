@extends('app.Blanck')
@section('titulo')
Formulario 
@endsection
@section('contenido')
  <div class="container">
    <div id="app" class="row">
      <form action="{{action('RentaController@save')}}" method="POST">
        {{csrf_field()}}
         <input type="hidden"name="idrenta" class="form-control" value="{{$renta->idrenta}}">
       
        <div class="form-group">
          <label class="form-label" for="">fecha inicio</label>
          <input type="text" v-model="fechainicio" name="fechainicio" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label" for="">fecha fin</label>
          <input type="text" v-model="fechafin" name="fechafin" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label" for="">precio</label>
          <input type="text" v-model="precio" name="precio"  class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label" for="">socio</label>
          <input type="hidden" v-model="idsocio" name="idsocio"  class="form-control">
        </div>
        <div v-if="bandera==1" class="alert alert-warning" role="alert">
          @{{mensaje}}
        </div>
        <input @click="validar_renta($event)" type="submit" class="btn btn-success" name="operacion" value="{{$operacion}}">

        @if($operacion=='Editar')
        <input type="submit" @click="confirmar_eliminar($event)" class="btn btn-danger" name="operacion" value="eliminar">
        @endif
        <input type="submit" class="btn btn-warning" name="operacion" value="cancelar">
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
        fechainicio:'{{$renta->fechainicio}}'
        ,fechafin:'{{$renta->fechafin}}'
        ,precio:'{{$renta->precio}}'
        ,idsocio:'{{$renta->idsocio}}'
        ,bandera:0
        ,mensaje:''

      }
      ,methods:{
        confirmar_eliminar:function(event){
          if(!confirm("Desea eliminar el renta?"))
            event.preventDefault();
        },
        validar_renta:function(event){
          this.bandera=0;
          this.mensaje='';
        
          if(this.fechainicio==''){
            this.bandera=1;
            this.mensaje+='fecha inicio vacio!!!';
          }
          if(this.fechafin==''){
            this.bandera=1;
            this.mensaje+='fecha fin vacio!!!';
          }
          if(this.precio==''){
            this.bandera=1;
            this.mensaje+='El precio vacio!!!';
          }
          if(this.idsocio==''){
            this.bandera=1;
            this.mensaje+='socio vacio!!!';
          }


          if(this.bandera==1)
            event.preventDefault();
        }
      }
    });
</script>
@endsection