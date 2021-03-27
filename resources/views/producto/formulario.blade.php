@extends('app.Blanck')
@section('titulo')
Product
@endsection
@section('contenido')
  <div class="container">
    <div id="app" class="row">
      <form action="{{action('ProductoController@save')}}" method="POST">
        {{csrf_field()}}
         <input type="hidden"name="idproducto" class="form-control" value="{{$producto->idproducto}}">
       
        <div class="form-group">
          <label class="form-label" for="">nombre</label>
          <input type="text"v-model="nombre" name="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label" for="">precio</label>
          <input type="text" v-model="precio" name="precio"  class="form-control">
        </div>
        <div v-if="bandera==1" class="alert alert-warning" role="alert">
          @{{mensaje}}
        </div>
        <input @click="validar_producto($event)" type="submit" class="btn btn-success" name="operacion" value="{{$operacion}}">

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
        nombre:'{{$producto->nombre}}'
        ,precio:'{{$producto->precio}}'
        ,bandera:0
        ,mensaje:''

      }
      ,methods:{
        confirmar_eliminar:function(event){
          if(!confirm("Desea eliminar el producto?"))
            event.preventDefault();
        },
        validar_producto:function(event){
          this.bandera=0;
          this.mensaje='';
        
          if(this.nombre==''){
            this.bandera=1;
            this.mensaje+='El nombre vacio!!!';
          }

          if(this.precio==''){
            this.bandera=1;
            this.mensaje+='El precio vacio!!!';
          }


          if(this.bandera==1)
            event.preventDefault();
        }
      }
    });
</script>
@endsection