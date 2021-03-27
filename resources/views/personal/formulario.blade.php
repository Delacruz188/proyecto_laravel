@extends('app.Blanck')
@section('titulo')
Formulario Personal
@endsection
@section('contenido')
  <div class="container">
    <div id="app" class="row">
      <form enctype="multipart/form-data" action="{{action('PersonalController@save')}}" method="POST">
        {{csrf_field()}}
         <input type="hidden"name="idpersonal" class="form-control" value="{{$personal->idpersonal}}">
       
        <div class="form-group">
          <label class="form-label" for="">nombre</label>
          <input type="text" v-model="nombre" name="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label" for="">curp</label>
          <input type="text" v-model="curp" name="curp"  class="form-control">
        </div>
        

        <div class="form-group">
          <label class="form-label" for="">sucursal</label>
          <input type="text" v-model="sucursal" name="sucursal"  class="form-control">
        </div>
        <div v-if="bandera==1" class="alert alert-danger" role="alert">
							@{{mensaje}}
					</div>


        <div class="form-group">
          <label class="form-label" for="">foto</label>
          <input type="file"
                  name="foto"
                  ref="campo"
                  id="foto" 
                  @change="cambiar"
                  class="form-control">
          <div id="dropzone"
              @dragover="sobre($event)"
              @dragleave="fuera($event)"
              @drop="drop($event)"
              :class="clase"
          >

          favor de colocar el archivo o hacer click<label class="form-label" id="carga_file" for="foto"><strong>Aqui</strong></label>
          </div>
          <div v-show="nombre_archivo!=''">
            <span>@{{nombre_archivo}}</span><a @click="remove" href="#">Quitar</a>
          </div>
        </div>
        <img :src="url" width="200" alt="">
        <input type="submit" @click="validar($event)" class="btn btn-success" name="operacion" value="{{$operacion}}">
    
        @if($operacion=='Editar')
        <input type="submit"  @click="confirmar_eliminar($event)" class="btn btn-danger" name="operacion" value="eliminar">
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
        nombre:'{{$personal->nombre}}'
        ,curp:'{{$personal->curp}}'
        ,sucursal:'{{$personal->idsucursal}}'
        ,tipos_permitidos:['image/png','image/jpeg', 'image/jpg']
        ,url:'{{URL::to('/')}}/'+'{{$personal->foto}}'
        ,nombre_archivo:''
        ,clase:{
          inactivo:true
          ,conarchivo:false
          ,leave:false
          ,invalido:false
        },
        mensaje:"",
        bandera:0
        
      }
      ,methods:{
        remove:function(){
          this.$refs.campo.value='';
          this.nombre_archivo='';
          this.url='';
        }
        ,cambiar:function(){
          ultimo=this.$refs.campo.files.length-1;
          if(this.tipos_permitidos.indexOf(this.$refs.campo.files[0].type)!=-1){
            this.nombre_archivo=this.$refs.campo.files[ultimo].name;
            this.url = URL.createObjectURL(this.$refs.campo.files[0]);
          }
          else{
            this.clase.leave=true;
            this.clase.conarchivo=false;
            this.clase.inactivo=false;
            this.clase.invalido=true;

          }
          
        }
        ,sobre:function(event){
          event.preventDefault();
          this.clase.leave=true;
          this.clase.conarchivo=false;
          this.clase.inactivo=false;
          this.clase.invalido=false;
          console.log('sobre');
        }
        ,fuera:function(event){
          event.preventDefault();
          this.clase.leave=false;
          this.clase.conarchivo=false;
          this.clase.inactivo=true;
          this.clase.invalido=false;
          console.log('fuera');
        }
        ,drop:function(event){
          this.$refs.campo.files=event.dataTransfer.files;
          this.clase.leave=false;
          this.clase.conarchivo=true;
          this.clase.inactivo=false;
          this.clase.invalido=false;
          event.preventDefault();
          this.cambiar();
        },
        validar:function(event) {
								this.bandera=0;
								this.mensaje="";
								if (this.nombre==="") {
									this.bandera=1;
									this.mensaje+="El nombre no puede estar vacio";

								}
								if (this.curp==="") {
									this.bandera=1;
									this.mensaje+="El curp no puede estar vacio";

								}
                if (this.sucursal==="") {
									this.bandera=1;
									this.mensaje+="sucursal no puede estar vacio";

								}
								if (this.bandera==1) {
									event.preventDefault();
								}
							}
      }
    });
</script>
@endsection