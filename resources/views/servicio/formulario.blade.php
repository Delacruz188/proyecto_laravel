@extends('app.blank')
@section('titulo')
Registrar servicio
@endsection
@section('contenido')
  <div class="container">
    <div class="row" id="app">
      <form action="{{action('BuscadorController@save')}}" method="POST">
        {{csrf_field()}}
        <!-- <div class="form-group">
          <label class="form-label" for="">cliente</label>
          <input type="text"name="cliente" class="form-control" value="">
        </div> -->
        <div class="form-group">
                <label>Nombre del socio</label>
                <select name="idsocio" v-model="idsocio" class="form-control"> 
                  <option v-for="socio in socios"  :value="socio.idsocio">@{{socio.nombre}}</option>
                </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="">Placa</label>
          <input type="text" name="placa" v-model="placa" class="form-control" value="">
        </div>
        <div class="form-group">
          <label class="form-label" for="">Modelo</label>
          <input type="text" name="modelo" v-model="modelo" class="form-control" value="">
        </div>
        <div class="form-group">
          <label class="form-label" for="">Año</label>
          <input type="text" name="ano" v-model="ano" class="form-control" value="">
        </div>
        <div class="form-group">
                <label>Tipo de servicio</label>
                <select name="idtiposervicio" v-model="idtiposervicio" class="form-control"> 
                  <option v-for="servicio in tiposservicio"  :value="servicio.idtiposervicio">@{{servicio.nombre}}</option>
                </select>
        </div>
        <div class="form-group">
                <label>Fecha de reservacion</label>
                <vuejs-datepicker 
                input-class="form-control"
                format="yyyy-MM-dd"
                :language="lenguaje"
                v-model="fecha_atencion_final"
                NAME="fecha_atencion_final"
                ></vuejs-datepicker>
        </div>
        <div class="form-group">
                <label>Personal a cargo</label>
                <select name="idpersonal" v-model="idpersonal" class="form-control"> 
                  <option v-for="personal in personales"  :value="personal.idpersonal">@{{personal.nombre}}</option>
                </select>
        </div>
        <div v-if="bandera==1" class="alert alert-danger" role="alert">
						@{{mensaje}}
				</div>
       
        <button type="submit"  @click="validar($event)" class="btn btn-success">Reservar</button>
      </form>
    </div>
  </div>
  <script src="{{asset('public/jquery.min.js')}}"></script>
  <script src="{{asset('public/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/vue.js')}}"></script>
  <script src="{{asset('public/vuejs-datepicker.min.js')}}"></script>
  <script src="{{asset('public/es.js')}}"></script>
  <script>
    new Vue({
      el:'#app',
      data:{
        socios:<?php echo json_encode($socios);?>
        ,tiposservicio:<?php echo json_encode($tiposservicio);?>
        ,personales:<?php echo json_encode($personales);?>
        ,mensaje:""
        ,bandera:0
        ,idsocio:""
        ,placa:""
        ,ano:""
        ,modelo:""
        ,idtiposervicio:""
        ,idpersonal:""
        ,lenguaje:vdp_translation_es.js
        ,fecha_atencion_final:""
        
      }
      ,methods:{
        validar:function(event) {
								this.bandera=0;
								this.mensaje="";
								if (this.idsocio==="") {
									this.bandera=1;
									this.mensaje+=", El nombre del socio no puede estar vacio";

								}
                if (this.placa==="") {
									this.bandera=1;
									this.mensaje+=", La placa no puede estar vacia";

								}
                if (this.modelo==="") {
									this.bandera=1;
									this.mensaje+=", El modelo no puede estar vacio";

								}
                if (this.ano==="") {
									this.bandera=1;
									this.mensaje+=", El anio no puede estar vacio";

								}
                if (this.idtiposervicio==="") {
									this.bandera=1;
									this.mensaje+=", El tipo de servicio no puede estar vacio";

								}
                if (this.idtiposervicio==="") {
									this.bandera=1;
									this.mensaje+=", El personal no puede estar vacio";

                }
                if (this.fechareservacion==="") {
									this.bandera=1;
									this.mensaje+=", La reservacion no puede estar vacia";

                }
                
								if (this.bandera==1) {
									event.preventDefault();
								}
							}
      },
      components:{
        vuejsDatepicker
      }
    });
</script>
  @endsection