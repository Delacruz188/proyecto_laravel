<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">  
    <title>catalogo de tiposervicios</title>

    
     
    <link rel="stylesheet" href="{{asset('public/bootstrap.css')}}">     
  </head>  
<body>
 
  <div class="container">
    <div id="app" class="row">
      <form action="{{action('TiposervicioController@save')}}" method="POST">
        {{csrf_field()}}
         <input type="hidden"name="idtiposervicio" class="form-control" value="{{$tiposervicio->idtiposervicio}}">
        
        <div class="form-group">
          <label class="form-label" for="">nombre</label>
          <input type="text"  v-model="nombre" name="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label" for="">tipo de servicio</label>
          <input type="text" v-model="servicio" name="servicio"  class="form-control">
        </div>
        <div v-if="bandera==1" class="alert alert-warning" role="alert">
          @{{mensaje}}
        </div>
        <input @click="validar_formulario($event)" type="submit" class="btn btn-success" name="operacion" value="{{$operacion}}">

        @if($operacion=='Editar')
        <input  type="submit" @click="confirmar_eliminar($event)" class="btn btn-danger" name="operacion" value="eliminar">
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
        nombre:'{{$tiposervicio->nombre}}'
        ,servicio:'{{$tiposervicio->servicio}}'
        ,bandera:0
        ,mensaje:''

      }
      ,methods:{
        confirmar_eliminar:function(event){
          if(!confirm("Desea eliminar el servicio?"))
            event.preventDefault();
        },
        validar_formulario:function(event){
          this.bandera=0;
          this.mensaje='';
          if(this.nombre==''){
            this.bandera=1;
            this.mensaje+='El nombre no puede estar vacio';
          }

          if(this.servicio==''){
            this.bandera=1;
            this.mensaje+='El servicio no puede estar vacio';
          }


          if(this.bandera==1)
            event.preventDefault();
        }
      }
    });

  </script>
</body></html>