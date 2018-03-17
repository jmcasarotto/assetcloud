<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Predictivo</h3>
          <?php

         //if (strpos($permission,'Add') !== false) {
            
            ?>
              <button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;"  id="btnAgre" >Agregar</button>
              
            
         <? 
      // }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="sales" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%" style="text-align: center">Acciones</th>
                <th style="text-align: center">Equipo</th>
                <th style="text-align: center">Tarea</th>
                <th style="text-align: center">Fecha</th>
                <th style="text-align: center">Periodo</th>
                <th style="text-align: center">Cantidad</th>
                <th style="text-align: center">Horas.H</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list['data']) > 0)                  
                  foreach($list['data'] as $a){

                    if ($a['estado'] == "C") {
                    $id=$a['predId'];
                    $ide=$a['id_equipo'];

                    echo '<tr id="'.$id.'" class="'.$ide.'">';
                    echo '<td style="text-align: center" >';
                   
                    if (strpos($permission,'Add') !== false) {
                      echo '<i class="fa fa-fw fa-times-circle" style="color:#A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar" data-toggle="modal" data-target="#modalaviso"></i>';

                      echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" ></i>';

                      // echo '<i class="fa fa-file-text" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" ></i>';
                    }
                    
                    
                    echo '</td>';
                    echo '<td style="text-align: center">'.$a['codigo'].'</td>';
                    echo '<td style="text-align: center">'.$a['de1'].'</td>';
                    echo '<td style="text-align: center">'.date_format(date_create($a['fecha']), 'd-m-Y').'</td>';
                    echo '<td style="text-align: center">'.$a['periodo'].'</td>';
                    echo '<td style="text-align: center">'.$a['cantidad'].'</td>';
                     echo '<td style="text-align: center">'.$a['horash'].'</td>';
                    
                   // echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                    
                    
                    echo '</tr>';
                  }
                    
                  }
                  
              
              ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<script>



var gloid="";
var globi="";

$(document).ready(function(event) {

  edit=0;  datos=Array();
  $('#btnAgre').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Predictivo/cargarpredictivo/<?php echo $permission; ?>");
    WaitingClose();
  });

  //Eliminar
  $(".fa-times-circle").click(function (e) { 
                 
    var idpre = $(this).parent('td').parent('tr').attr('id');
    console.log("ESTOY ELIMINANDO , el id de predictivo es:");
    console.log(idpre);
    gloid=idpre;
                                
  });    
  //Editar
  $(".fa-pencil").click(function (e) { 
            
    $('#modalSale').modal('show');

    var idpred = $(this).parent('td').parent('tr').attr('id');
    var ide = $(this).parent('td').parent('tr').attr('class');
    console.log("Id de predictivo");
    console.log(idpred);
    globi=idpred;
    console.log("Id de equipo");
    console.log(ide);  
    datos= parseInt(ide);
    console.log(datos); 

    $.ajax({
      type: 'GET',
      data: { idpred: idpred, datos:datos},
      url: 'index.php/Predictivo/geteditar', //index.php/
      success: function(data){
              //var data = jQuery.parseJSON( data );
              
              console.log(data);
              console.log("codigo");
              console.log(data['datos'][0]['tarea_descrip']);
              datos={
             
                  'id_equipo':data['equipo'][0]['id_equipo'], 
                  'codigo':data['equipo'][0]['codigo'],
                  'marca':data['equipo'][0]['marca'],
                  'descripcion':data['equipo'][0]['descripcion'],
                  'fecha_ingreso':data['equipo'][0]['fecha_ingreso'],
                  'tarea': data['datos'][0]['tarea_descrip'],
                  'fecha':data['datos'][0]['fecha'],
                  'periodo':data['datos'][0]['periodo'],
                  'cantidad':data['datos'][0]['cantidad']
             
               
              }

              
                completarEdit(datos);          
          
            },
        
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
    });

  });

  $('#equipo').change(function(){
        
    var id_equipo = $(this).val();
    $.ajax({
      type: 'POST',
      data: { id_equipo: id_equipo},
      url: 'index.php/Preventivo/getcantidad', //index.php/
      success: function(data){
                      //var data = jQuery.parseJSON( data );
                      
              console.log(data);
                     
              var fecha_ingreso = data[0]['fecha_ingreso']; 
              var marca = data[0]['marca']; 
              var ubicacion = data[0]['ubicacion']; 
              var criterio1 = data[0]['criterio1']; 
              var descripcion = data[0]['descripcion']; 


              $('#fecha_ingreso').val(fecha_ingreso);       
              $('#marca').val(marca);   
              $('#descripcion').val(descripcion);       
              $('#ubicacion').val(ubicacion);  

            },
        
      error: function(result){
                    
              console.log(result);
            },
      dataType: 'json'
      });
      //traer_componente(id_equipo);      
 
  });

  $(".fa-file-text").click(function(){
    
    var idp=$(this).parent('td').parent('tr').attr('id'); 
    var ide = $(this).parent('td').parent('tr').attr('class');
    console.log("El id de predictivo es:");
    console.log(idp);
    console.log("El id de equipo es:");
    console.log(ide);
    datos= parseInt(ide);
    console.log(datos); 

    $.ajax({
      type: 'POST',
      data: { idp: idp, datos:datos},
      url: 'index.php/Predictivo/getpredictivo', //index.php/
      success: function(data){
                          
              console.log(data);
             
              var equipo=data[0]['id_equipo'];
              var tarea=data[0]['tarea_descrip'];
              var fecha=data[0]['fecha'];

              $.ajax({
                  type: 'POST',
                  data: { idp:idp, equipo: equipo, tarea:tarea, fecha:fecha},
                  url: 'index.php/Predictivo/predictivoinertot', //index.php/
                  success: function(data){
                          console.log("Inserte una orden");          
                          console.log(data);
                         

                          $('#content').empty();
                          $("#content").load("<?php echo base_url(); ?>index.php/Predictivo/volver/<?php echo $permission; ?>");
                                               
                         
                        },
                    
                  error: function(result){
                                
                          console.log(result);
                        }
                  //dataType: 'json'
                });

                     
             
            },
        
      error: function(result){
                    
              console.log(result);
            },
      dataType: 'json'
    });

  });

  $(".datepicker").datepicker({
      
      changeMonth: true,
      changeYear: true
  });

  $('#sales').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                      "lengthMenu": "Ver _MENU_ filas por página",
                      "zeroRecords": "No hay registros",
                      "info": "Mostrando página _PAGE_ de _PAGES_",
                      "infoEmpty": "No hay registros disponibles",
                      "infoFiltered": "(filtrando de un total de _MAX_ registros)",
                      "sSearch": "Buscar:  ",
                      "oPaginate": {
                          "sNext": "Sig.",
                          "sPrevious": "Ant."
                                  }
                            }
  });

});

     
function eliminarpred(){

  var idpre = $(this).parent('td').parent('tr').attr('id');
  console.log("Estoy por la opcion SI a eliminar")
  console.log(gloid);
          
  $.ajax({
    type: 'POST',
    data: { gloid: gloid},
    url: 'index.php/Predictivo/baja_predictivo', //index.php/
    success: function(data){
            //var data = jQuery.parseJSON( data );
            console.log(data);  
            Refrescar1();
          },
      
    error: function(result){
          
          console.log(result);
        }
        //dataType: 'json'
  });

}


function completarEdit(datos){
    
 // $('select#id_equipo').append($('<option />', { value: datos['id_equipo'],text: datos['codigo']}));
 $('#equipo').val(datos['id_equipo']);
  $('#fecha_ingreso').val(datos['fecha_ingreso']);
  $('#marca').val(datos['marca']);
  $('#ubicacion').val(datos['ubicacion']);
  $('#descripcion').val(datos['descripcion']);
  $('#tarea').val(datos['tarea']);
  $('#fecha').val(datos['fecha']);
  $('#periodo').val(datos['periodo']);
  $('#cantidad').val(datos['cantidad']);



}

function guardar(){

  var equipo = $('#equipo').val();
  var tarea = $('#tarea').val();
  var periodo = $('#periodo').val();
  var cantidad = $('#cantidad').val();
  var fecha = $('#fecha').val();


  console.log("estoy editando");
 
  $.ajax({
    type: 'POST',
    data: {equipo:equipo, tarea:tarea, periodo:periodo,cantidad:cantidad, fecha:fecha, globi:globi},
    url: 'index.php/Predictivo/editar_predictivo',  //index.php/
    success: function(data){
           
            console.log(data);
            console.log("exito");
            Refrescar();                     
          },
    error: function(result){
          
          console.log(result);
          console.log("Entre por el error");
          //$('#modalSale').modal('hide');
        }
       // dataType: 'json'
    });
}

traer_equipo();

function traer_equipo(){
    $.ajax({
      type: 'POST',
      data: { },
      url: 'index.php/Predictivo/getequipo', //index.php/
      success: function(data){
             
               var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#equipo').append(opcion); 
              for(var i=0; i < data.length ; i++) 
              {    
                    var nombre = data[i]['codigo'];
                    var opcion  = "<option value='"+data[i]['id_equipo']+"'>" +nombre+ "</option>" ; 

                  $('#equipo').append(opcion); 
                                 
              }
            },
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
      });
}

traer_tarea();
function traer_tarea(){
    $.ajax({
      type: 'POST',
      data: { },
      url: 'index.php/Preventivo/gettarea', //index.php/
      success: function(data){
             
               var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#tarea').append(opcion); 
              for(var i=0; i < data.length ; i++) 
              {    
                    var nombre = data[i]['descripcion'];
                    var opcion  = "<option value='"+data[i]['id_tarea']+"'>" +nombre+ "</option>" ; 

                  $('#tarea').append(opcion); 
                                 
              }
            },
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
      });
}

function Refrescar(){

  $('#content').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Predictivo/index/<?php echo $permission; ?>");
  WaitingClose();
}
function Refrescar1(){

  $("#content").load("<?php echo base_url(); ?>index.php/Predictivo/index/<?php echo $permission; ?>");
  
}
  
</script>
<!-- Datepicker -->
<script>     
  $("#fecha").datepicker({
    Format: 'dd/mm/yy',
    startDate: '-3d'
    //firstDay: 1
  }).datepicker("setDate", new Date());
</script>

<!-- Modal modalSale -->
<div class="modal fade" id="modalSale" tabindex="2000" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">
      
      <div class="modal-header">


        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale" class="fa fa-fw fa-pencil" style="color: #A4A4A4"> </span> Predictivo</h4> 
      </div>

      <div class="modal-body" id="modalBodySale">
      
        <div role="tabpanel" class="tab-pane">
            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title fa fa-cogs">  Datos del Equipo </h3>
                </div>
     
                    <div class="panel-body">

                      <div class="col-xs-4">Equipos <strong style="color: #dd4b39">*</strong>
                           <select  id="equipo" name="equipo" value="" class="form-control" ></select>
                           <input type="hidden" id="id_equipo" name="id_equipo">
                      </div>
                      <div class="col-xs-10">
                          
                      </div>

                      <div class="col-xs-4">Fecha:
                        <input type="text" id="fecha_ingreso"  name="fecha_ingreso" class="form-control input-md" disabled />
                      </div>
                      <div class="col-xs-4">Marca:
                        <input type="text" id="marca"  name="marca" class="form-control input-md"  disabled />
                      </div>
                       
                      <div class="col-xs-4">Ubicacion:
                        <input type="text" id="ubicacion"  name="ubicacion" class="form-control input-md" disabled/>
                      </div>
                       
                      <br>
                      <div class="col-xs-8">Descripcion: 
                      </div> 

                      <div class="row">
                        <div class="col-xs-12">
                        
                        <textarea class="form-control" id="descripcion" name="descripcion" disabled></textarea>
                        </div>
                      </div>
                    </div>
              </div>
            </div>
        </div> 
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <div role="tabpanel" class="tab-pane">
              <div class="form-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">Programación</h4>
                    </div>

                    <div class="panel-body">  

                      <div class="col-xs-4">Tarea <strong style="color: #dd4b39">*</strong>:
                        <select id="tarea" name="tarea" class="form-control"   />                             
                      </div> 
                      <div class="col-xs-4">Fecha:
                        <input type="text" class="datepicker form-control fecha" id="fecha" name="vfecha" value="<?php echo date_format(date_create(date("Y-m-d H:i:s")), 'd-m-Y H:i:s') ; ?>" size="27"/>
                        
                      </div>                        
                      <div class="col-xs-4">Periodo:
                        <select id="periodo"  name="periodo" class=" selectpicker form-control input-md" value="">
                            <option >Anual</option>
                            <option >Diario</option>
                            <option >Mensual</option>
                            <option >Periodos</option>
                            <option >Ciclos</option>
                            <option >Semestral</option>
                                      
                          </select>                   
                      </div> 
                      <br>
                      <br>
                      <div class="col-xs-4">
                      </div>
                      <br>
                      <br>
                      <div class="col-xs-4">Cantidad:
                        <input type="text" class="form-control" id="cantidad" name="cantidad"/>
                      </div>           
                    </div>
                </div>
             
              </div>

            </div>
          </div>        
        </div>
   

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
          <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="guardar()">Guardar</button>
        </div>
      </div>
    </div>
   </div>
</div>

<div class="modal fade" id="modalaviso">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><span class="fa fa-fw fa-times-circle" style="color:#A4A4A4"></span>  Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
        <h4><p>¿ DESEA ELIMINAR PREDICTIVO ?</p></h4>
        </center>
      </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="eliminarpred()">SI</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        </center>
      </div>
    </div>
  </div>
</div>


