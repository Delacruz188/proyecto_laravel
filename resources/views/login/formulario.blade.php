@extends('app.blank')
@section('titulo')
Formulario socios
@endsection
@section('contenido')

  <div class="container">
    <div id="app" class="row">
      <form enctype="multipart/form-data" action="{{action('Auth\RegisterController@register')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" class="form-control" name="tiporegistro" value="registrootro">
        <div class="form-group">
          <label class="form-label" for="">EMAIL</label>
          <input type="text" v-model="email" name="email" class="form-control">
        </div>

        <div class="form-group">
          <label class="form-label" for="">PASSWORD</label>
          <input type="text" v-model="password" name="password" class="form-control">
        </div>

        <div class="form-group">
                <labe>TIPO USUARIO</label>
                <select v-model="idrol" name="idrol" class="form-control"> 
                  <option v-for="elemento in tiporol"  :value="elemento.idrol">@{{elemento.nombre}}</option>
                  
                </select>
        </div>
        <div v-if="bandera==1" class="alert alert-danger" role="alert">
							@{{mensaje}}
					</div>
        <input type="submit" @click="validar($event)" class="btn btn-success" name="operacion" value="Agregar">
    
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
        tiporol:<?php echo json_encode($tiporol);?>
        ,mensaje:""
        ,bandera:0,
        email:"",
        nombre:"",
        password:"",
        idrol:""
        
      }
      ,methods:{
        validar:function(event) {
								this.bandera=0;
								this.mensaje="";
								if (this.email==="") {
									this.bandera=1;
									this.mensaje+=" El email no puede estar vacio";

								}
                if (this.idrol==="") {
									this.bandera=1;
									this.mensaje+=" Seleccione el tipo de usuario";

								}
                if (this.password==="") {
									this.bandera=1;
									this.mensaje+=" Introduzca una contrasena";

								}
								if (this.bandera==1) {
									event.preventDefault();
								}
							}
      }
    });
</script>
@endsection