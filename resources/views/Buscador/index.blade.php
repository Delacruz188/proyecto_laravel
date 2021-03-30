@extends('app.Blanck')
@section('titulo')
Buscador de socios
@endsection
@section('contenido')
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form action="{{action('BuscadorController@index')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
              <input type="text" name="criterio" value="{{$criterio}}" placeholder="Puedes introducir: nombre del socio, nombre del empleado o numero de placa" class="form-control"></input>
            </div>
            <button class="btn btn-success">Buscar</button>
          </form>
        </div>
      </div>
      <div id="app" class="row">
        <div v-if="registros.length!=0" class="col-md-12 col-xs-12 col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Busqueda Rapida</h3>
            </div>
            <div class="panel-body">
              <div class="form-group">
                <labe>Tipo de servicio</label>
                <select class="form-control" v-model="filtro_tipo"> 
                  <option v-for="tipo in tipos" :value="tipo">@{{tipo}}</option>
                </select>
              </div>
              <div class="form-group">
                <labe>Modelo</label>
                <select class="form-control" v-model="filtro_modelo"> 
                  <option v-for="modelo in modelos" :value="modelo">@{{modelo}}</option>
                </select>
              </div>
              <div class="form-group">
                <labe>Tipo de socio</label>
                <select class="form-control" v-model="filtro_socio"> 
                  <option v-for="tiposoc in tipsocio" :value="tiposoc">@{{tiposoc}}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
          <h1>Resultados de Busqueda</h1>
          <table class="table">
            <tr>
              <th>Socio</th>
              <th>Tipo de Socio</th>
              <th>Placa</th>
              <th>Precio</th>
              <th>Personal quien realizó el trabajo</th>
              <th>Modelo</th>
              <th>Año</th>
              <th>Tipo de servicio</th>
              <th>Fecha de registro</th>
              <th>Fecha de reservación</th>

            </tr>
            <tr v-for="elemento in registros_final">
              <td>@{{elemento.socio}}</td>
              <td>@{{elemento.tiposocio}}</td>
              <td>@{{elemento.placa}}</td>
              <td>@{{elemento.precio}}</td>
              <td>@{{elemento.personal}}</td>
              <td>@{{elemento.modelo}}</td>
              <td>@{{elemento.anio}}</td>
              <td>@{{elemento.tiposervicio}}</td>
              <td>@{{elemento.fecharegistro}}</td>
              <td>@{{elemento.fechareservacion}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <script src="{{asset('public/jquery.min.js')}}"></script>
    <script src="{{asset('public/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/vue.js')}}"></script>
    <script>  
      new Vue({
        el:'#app',
        data:{
          registros:<?php echo json_encode($registros);?>
          ,filtro_tipo:'todos'
          ,filtro_modelo:'todos',
           filtro_socio:'todos'
          ,tipos:[]
          ,modelos:[]
          ,tipsocio:[]
          
         

        }
        ,methods:{
          borrar:function(){
            this.registros_final.splice(0,this.registros_final.length);

          }
          ,filtrar_basico:function(){
            this.filtro_tipo='Basico';
            
          }
          ,filtrar:function(){
            this.borrar();
            for(i=0;i<this.registros.length;i++){
              bandera=false;
              if(this.filtro_tipo=='todos')
                bandera=true;
              else{
                if(this.filtro_tipo==this.registros[i].tiposervicio)
                  bandera=true;
              }
              if(bandera){
                this.registros_final.push(this.registros[i]);
              }
            }
          }
        }
        ,computed:{
          registros_final:function(){
            lista=[];
            
            self=this;
            lista=this.registros.filter(function(item){
              bandera_tipo=false;
              bandera_modelo=false;
              bandera_tiposocio=false;
              if(self.filtro_tipo=='todos')
               bandera_tipo=true;
             else{
               if(self.filtro_tipo==item.tiposervicio)
                 bandera_tipo=true;
             }

             if(self.filtro_modelo=='todos')
               bandera_modelo=true;
             else{
               if(self.filtro_modelo==item.modelo)
                 bandera_modelo=true;
             }

             if(self.filtro_socio=='todos')
               bandera_tiposocio=true;
             else{
               if(self.filtro_socio==item.tiposocio)
                 bandera_tiposocio=true;
             }


             return bandera_tipo&&bandera_modelo&&bandera_tiposocio;
            })
            return lista;
          }
        }
        ,created(){
          this.tipos.push('todos');
          this.modelos.push('todos');
          this.tipsocio.push('todos');
          for(i=0;i<this.registros.length;i++){
            if(this.tipos.indexOf(this.registros[i].tiposervicio)==-1){
              this.tipos.push(this.registros[i].tiposervicio)
            }
            if(this.modelos.indexOf(this.registros[i].modelo)==-1){
              this.modelos.push(this.registros[i].modelo)
            }
            if(this.tipsocio.indexOf(this.registros[i].tiposocio)==-1){
              this.tipsocio.push(this.registros[i].tiposocio)
            }
          }
        },filters:{
          formato_fecha:function(fecha){
            datos=fecha.split('-');
            anio=datos[0];
            mes=datos[1];
            dia=datos[2];
            switch (mes) {
              case '01':
                mes='enero';
              break;
              case '02':
                mes='febrero';
              break;
              case '03':
                mes='marzo';
              break;
              case '04':
                mes='abril';
              break;
              case '05':
                mes='mayo';
              break;
              case '06':
                mes='junio';
              break;
              case '07':
                mes='julio';
              break;
              case '08':
                mes='agosto';
              break;
              case '09':
                mes='septiembre';
              break;
              case '10':
                mes='octubre';
              break;
              case '11':
                mes='noviembre';
              break;
              case '12':
                mes='diciembre';
              break;
              
            }
            cadena_fecha=dia+" de "+mes+" del "+anio;
            return cadena_fecha;
          }
          
        }
        
      });

    </script>
@endsection
