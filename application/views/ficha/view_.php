<input type="hidden" id="permission" value="<?php echo $permission;?>">
 <div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Revise que todos los campos obligatorios esten seleccionados
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error1" style="display: none">
          <h4><i class="icon fa fa-ban"></i> ALERTA!</h4>
          Este equipo! SI tiene datos tecnicos cargados
      </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="box">
        <div class="box-header">
        <h3 class="box-title">Datos Tecnicos</h3>
        <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="listado">Ver Listado</button>';
            //echo $list[0]['id_equipo'];

            
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div role="tabpanel" class="tab-pane">
            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title fa fa-cogs">   Datos a Ingresar del Equipo </h3>
                </div>
     
                <div class="panel-body">
                 
                  <div class="col-xs-4">Numero de serie <strong style="color: #dd4b39">*</strong>:
                       <input type="text" id="numserie" name="numserie" class="form-control"  placeholder="Ingrese numero de serie..." value="<?php echo $list[0]['numero_serie'] ?>">
                        
                    </div>
                    <div class="col-xs-4">Marca del motor <strong style="color: #dd4b39">*</strong>:
                      <input type="text" id="marcamoto" name="marcamoto" class="form-control" placeholder="Ingrese marca del motor..." value="<?php echo $list[0]['marca'] ?>">
                    </div>
                    <div class="col-xs-4">Modelo del motor <strong style="color: #dd4b39">*</strong>:
                      <input type="text" id="modelomoto" name="modelomoto" class="form-control" placeholder="Ingrese Modelo del motor" value="<?php echo $list[0]['modelo'] ?>"> 
                    </div>
                    <div class="col-xs-4">Numero del motor <strong style="color: #dd4b39">*</strong>:
                      <input type="text" id="numeromoto" name="numeromoto" class="form-control" placeholder="Ingrese NUmero de motor..." value="<?php echo $list[0]['numero_serie'] ?>">  
                    </div>
                    
                    <div class="col-xs-4">Fecha de ingreso a la reparacion:
                      <input type="date" id="fechrep"  name="fechrep" class="form-control input-md" value="<?php echo $list[0]['fecha_ingreso'] ?>">
                    </div>
                    <div class="col-xs-4">Dominio <strong style="color: #dd4b39">*</strong>:
                      <input type="text" id="dom" name="dom" class="form-control" placeholder="Ingrese Dominio..." value="<?php echo $list[0]['dominio'] ?>">   
                    </div>
                    
                    <div class="col-xs-4">Peso operativo
                        <input type="text" id="peso"  name="peso" class="form-control input-md" placeholder="Ingrese Peso..." value="<?php echo $list[0]['peso'] ?>">
                    </div>
                    <div class="col-xs-4">Baterias
                        <input type="text" id="bater"  name="bater" class="form-control input-md" placeholder="Ingrese Baterias..." value="<?php echo $list[0]['bateria'] ?>">
                    </div>
                    <div class="col-xs-4">Año de fabricación
                        <input type="text" id="anfa"  name="anfa" class="form-control input-md" placeholder="Ingrese Año ..." value="<?php echo $list[0]['fabricacion'] ?>">
                    </div> 
                    <div class="col-xs-4">
                      <input type="hidden"  id="numequip" name="numequip" value="<?php echo $id_equipo;?>"> </input>
                    </div>   
                    
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane">
                  <div class="form-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title fa fa-file-text-o icotitulo">   Poliza de Seguro </h3>
                      </div>
           
                      <div class="panel-body">
                        <br>
                          <div class="col-xs-4">
                            <button type="button" class="btn btn-success" id="addseguro"  data-toggle="modal" data-target="#modalasegurado" ><i class="fa fa-plus"> Agregar Poliza de Seguro</i></button>
                            <!--onclick="funcionpol()"-->

                             
                         </div> 
                          
                          
                      </div>
                    </div>
                  </div>
                </div>
       
              </div>
            </div>
          </div>
            
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpiar()">Cancelar</button>
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarficha()">Guardar</button>
          </div>

            </div><!-- cierre body -->
          </div>
        </div>
      </div>
    </div>
</section>
<!-- Carga vista -->
<script>
 var isOpenWindow = false;
  var comglob="";
  var ide="";
  var idglob= "";
$(document).ready(function(event) {
  
  edit=0;  datos=Array()  
  $('#listado').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Equipo/index/<?php echo $permission; ?>");
    WaitingClose();
  });

  $("#addseguro").click(function (e) {

    var equipo= $('#numequip').val();
    idglob=equipo;

  });
 

});


function OpenSale(){

  var btn = $('#btnAgre');
  if(btn.is(':enabled')){
    //Abrir ventana de facturación
    if(isOpenWindow == false){
      isOpenWindow = true;
      LoadIconAction('modalActionSale','Add');
      WaitingOpen('Cargando...');
      $('#modalSale').modal({ backdrop: 'static', keyboard: false });
      $('#modalSale').modal('show');
      // $('#modalbaja').modal('show');
      setTimeout(function () { $('#artId').focus(); }, 1000);
      $('#saleDetail > tbody').html('');
     
      WaitingClose();
     
    }
  }
}

function regresa(){

  $('#content').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Equipo/index/<?php echo $permission; ?>");
  WaitingClose();
}

function cerro(){
  
  isOpenWindow = false;
}

traer_asegurado();
function traer_asegurado(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getasegurado', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#asegurado').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['asegurado'];
                      var opcion  = "<option value='"+data[i]['id_seguro']+"'>" +nombre+ "</option>" ; 

                    $('#asegurado').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
}

function traer_codigo(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Ficha/getcodigo', //index.php/
        success: function(data){
               
                 //var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#codigo').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                  var nombre = data[i]['codigo'];
                  var opcion  = "<option value='"+data[i]['id_equipo']+"'>" +nombre+ "</option>" ; 

                  $('#codigo').append(opcion); 
                                   
                }
                
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
      });
}

function guardarficha(){

  console.log("El id de equipo es:");
  console.log(idglob);
  console.log(numequip);
  idglob= $('#numequip').val();
  var equipo = $('#numequip').val();
  var marca = $('#marcamoto').val();
  var modelo = $('#modelomoto').val();
  var numerose= $('#numserie').val();
  var nummoto = $('#numeromoto').val();
  var fecha_ingreso = $('#fechrep').val();
  var dominio = $('#dom').val();
  var peso = $('#peso').val();
  var bateria = $('#bater').val();
  //var estado = $('#estado').val();
  var ano = $('#anfa').val();
  var seguro = $('#asegurado').val();
  var parametros = {
     // 'id_equipo': id_equipo,
      'id_equipo': equipo,
      'marca': marca,
      'modelo': modelo,
      'numero_motor': nummoto,
      'numero_serie': numerose,
      'fecha_ingreso': fecha_ingreso,
      'dominio': dominio,
      'fabricacion': ano,
      'peso': peso,
      'bateria': bateria,
      'hora_lectura' : 0,
     // 'id_seguro' : seguro
     
  };

  console.log(parametros);
  $.ajax({
    type: 'POST',
    data: {data:parametros},
    url: 'index.php/Equipo/guardar_ficha',  //index.php/
    success: function(data){
           
            console.log(data);
            
            regresa();                    
          },
    error: function(result){
          
          console.log(result);

        }
        //dataType: 'json'
  });
}


function guardarseguro(){ 

   console.log("ID  de equipo es:");
   console.log(idglob);
    var asegurado1 = $('#asegurado1').val();
    var ref1 = $('#ref').val();
    var poliza1 = $('#poliza').val();
    var fechainicial= $('#fechaini').val();
    var fechahasta = $('#fechahasta').val();
    var cobertura1 = $('#cobertura').val();
       
    var parametros = {
       // 'id_equipo': id_equipo,
        'asegurado': asegurado1,
        'ref': ref1,
        'numero_pliza': poliza1,
        'fecha_inicio': fechainicial,
        'fecha_vigencia': fechahasta,
        'cobertura': cobertura1,
        'id_equipo' :idglob
               
    };

    console.log("Estoy Guardando seguro");
    console.log(parametros);
    var hayError = false; 
    if( parametros !=0){                                     
      $.ajax({
        type:"POST",
        url: "index.php/Equipo/agregar_seguro", //controlador /metodo
        data:{parametros:parametros},
        success: function(data){
          console.log("exito");
          var datos= parseInt(data);
          console.log(datos);
            //alert(data);
            if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
            {  
              
                //var texto = '<option value="'+data+'">'+ parametros.asegurado +'</option>';
                //console.log(texto);
                $('select#asegurado').append($('<option />', { value: data, text: parametros.asegurado}));
              

               // $('#asegurado').append(texto);
            }
             

          },
        
        error: function(result){
            console.log("entro por el error");
            console.log(result);
        },
         dataType: 'json'
      });
   
    }
    else { 
      alert("Por favor complete los campo obligatorio");

    }

}

</script>
  
  <!-- Modal asegurado -->
 <div class="modal fade" id="modalasegurado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span>Agregar Seguro </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
           <div class="col-xs-8">Asegurado <strong style="color: #dd4b39">*</strong>:
            <input type="text" id="asegurado1" name="asegurado1" class="form-control"  placeholder="Ingrese Nombre del asegurado...">     
          </div>
          <div class="col-xs-8">Ref <strong style="color: #dd4b39">*</strong>:
            <input type="text" id="ref" name="ref" class="form-control"  placeholder="Ingrese Ref...">     
          </div>
          <div class="col-xs-8">Poliza <strong style="color: #dd4b39">*</strong>:
            <input type="text" id="poliza" name="poliza" class="form-control"  placeholder="Ingrese Poliza...">     
          </div>
          <div class="col-xs-8">Vigencia desde <strong style="color: #dd4b39">*</strong>:
            <input type="date" id="fechaini" name="fechaini" class="form-control" >     
          </div>
          <div class="col-xs-8">Hasta <strong style="color: #dd4b39">*</strong>:
              <input type="date" id="fechahasta" name="fechahasta" class="form-control" >     
          </div>
          <div class="col-xs-8">Cobertura <strong style="color: #dd4b39">*</strong>:
              <input type="text" id="cobertura" name="cobertura" class="form-control" >     
          </div>
          <div class="col-xs-4">
            <input type="hidden" class="numSolic form_equipos" id="numequip" name="numequip" value="<?php echo $id_equipo;?>"> </input>
         </div> 
                    
                    
          </div>
        </div>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarseguro()" >Guardar</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->
