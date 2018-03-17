
<input type="hidden" id="permission" value="<?php echo $permission;?>">
 <div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Revise que todos los campos obligatorios esten seleccionados
      </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="box">
        <div class="box-header">
        <h3 class="box-title">Programación Predictivo</h3>
        <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="listado">Ver Listado</button>';
          }
          ?>
        </div><!-- /.box-header -->
        
        <div class="box-body">
          <div role="tabpanel" class="tab-pane">
            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title fa fa-cogs"> Datos del equipo </h3>
                </div>
     
                    <div class="panel-body">

                        <div class="col-xs-4">Equipos <strong style="color: #dd4b39">*</strong>
                           <select  id="equipo" name="equipo" class="form-control" />
                          <!-- <input type="hidden" id="id_equipo" name="id_equipo">-->
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
                        <textarea class="form-control" id="descripcion" name="descripcion" disabled></textarea>
                        </div> 

                        <!--<div class="row">
                          <div class="col-lg-12">
                          
                          <textarea class="form-control" id="descripcion" name="descripcion" disabled></textarea>
                          </div>
                        </div>-->
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
                              <h4 class="panel-title fa fa-building-o">      Programación </h4>
                            </div>

                            <div class="panel-body">  
                              <div class="col-xs-4">Tarea <strong style="color: #dd4b39">*</strong>:
                                <select id="tarea" name="tarea" class="form-control"   />
                               <!--<input type="hidden" id="id_tarea" name="id_tarea">-->
                              </div>
                        <div class="col-xs-4">Fecha:
                          <input type="text" class="datepicker form-control fecha" id="fecha" name="vfecha" value="<?php echo date_format(date_create(date("Y-m-d H:i:s")), 'd-m-Y H:i:s') ; ?>" size="27"/>
                          
                        </div> 
                        
                        <div class="col-xs-4">Periodo:
                         <!-- <input type="text" class="form-control" id="periodo" name="periodo"/>-->
                          <select id="periodo"  name="periodo" class=" selectpicker form-control input-md">
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
                        <div class="col-xs-4">Frecuencia:
                          <input type="text" class="form-control" id="cantidad" name="cantidad"/>
                        </div> 
                          <div class="col-xs-4">Duración:
                          <input type="text" class="form-control" id="horash" name="horash"/>
                        </div> 




                        <!-- <div class="row">
                          <div class="col-lg-12">
                          
                          <textarea class="form-control" id="descripcion" name="descripcion" disabled></textarea>
                          </div>
                        </div> -->
                    </div>
              </div>
            </div>
          </div>
         
            <!--         <div class="row" >
                  <div class="col-sm-12 col-md-12">
                    <div role="tabpanel" class="tab-pane">
                      <div class="form-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title fa fa-building-o">      Nueva Tarea </h4>
                            </div>

                            <div class="panel-body">  

                              <div class="col-xs-4">Tarea <strong style="color: #dd4b39">*</strong>:
                               <input id="tarea" name="tarea" class="form-control"   />-->
                               <!--<input type="hidden" id="id_tarea" name="id_tarea">-->
                    <!--           </div>
                              <input type="hidden" id="id" name="id">

                              
                              <div class="col-xs-4">Fecha:
                                <input type="date" id="ultimo"  name="ultimo" class="form-control " />
                              </div>                                       
                        </div>
                      </div> -->

          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm delete" onclick="limpiar()">Cancelar</button>
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardar()">Guardar</button>
          </div>
        </div>
      </div>
    </div>
</section>

<script>

 

var codhermglo="";
var codinsumolo="";
var preglob="";

$('#listado').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Predictivo/index/<?php echo $permission; ?>");
    WaitingClose();
});

$(".datepicker").datepicker({
    
    changeMonth: true,
    changeYear: true
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
  traer_componente(id_equipo);      
 
});

      


$("#componente").change(function () {

    var id_componente= $(this).val();
    console.log(id_componente);

});
    //var cantglob="";
$("#agregarherr").click(function (e) {
      
  var id_herramienta= $("#herramienta").val(codhermglo);
  var id_her=codhermglo;
  console.log("herramienta"+id_her);
  var $herramienta = $("select#herramienta option:selected").html(); 
  var marcaherram = $('#marcaherram').val();
  var descripcionherram = $('#descripcionherram').val();
  var cantidadherram = $('#cantidadherram').val();
  var hayError = false;
  var tr = "<tr id='"+id_her+"'>"+
                "<td ><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
                "<td>"+$herramienta+"</td>"+
                "<td>"+marcaherram+"</td>"+
                "<td>"+descripcionherram+"</td>"+
                "<td>"+cantidadherram+"</td>"+
                
            "</tr>";
  console.log(tr);
  $('#tablaherramienta tbody').append(tr);

   /*}
   else {
       var hayError = true;
              $('#error').fadeIn('slow');
              return;
            }

          if(hayError == false){
            
            $('#error').fadeOut('slow');
          }*/

   
  $(document).on("click",".elirow",function(){
    var parent = $(this).closest('tr');
    $(parent).remove();
  });
  $('#herramienta').val('');
  $('#marcaherram').val(''); 
  $('#descripcionherram').val(''); 
  $('#cantidadherram').val(''); 
       
 });

  $("#agregarins").click(function (e) {

    var id_insumo= $('#insumo').val(codinsumolo);
    var id_in= codinsumolo;


    var $insumo = $("select#insumo option:selected").html();
    var descript = $('#descript').val();
    var cant = $('#cant').val();
      //var datos=Array();
      //datos=marca.split('%%');  //class='quitarEquipo'
    console.log("El id  del insumo");
    console.log(id_in);
       var hayError = false;

    var tr = "<tr id='"+id_in+"'>"+
                  "<td ><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
                  "<td>"+$insumo+"</td>"+
                  "<td>"+descript+"</td>"+
                  "<td>"+cant+"</td>"+
                  
              "</tr>";

    if(id_in >0 && cant >0){
    $('#tablainsumo tbody').append(tr);
      
   
  }
  else {
     var hayError = true;
            $('#error').fadeIn('slow');
            return;
          }

        if(hayError == false){
          
          $('#error').fadeOut('slow');
        }


    $(document).on("click",".elirow",function(){
      var parent = $(this).closest('tr');
      $(parent).remove();
    });

     
    $('#insumo').val('');
    $('#descript').val(''); 
    $('#cant').val(''); 


  });

traer_equipo();

function traer_equipo(){
  $('#equipo').html(''); 
    $.ajax({
      type: 'POST',
      data: { },
      url: 'index.php/Preventivo/getequipo', //index.php/
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
   $('#tarea').html('');
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

traer_componente();
function traer_componente(id_equipo){
    $('#componente').html("");
    $.ajax({
      type: 'POST',
      data: {id_equipo: id_equipo },
      url: 'index.php/Preventivo/getcomponente', //index.php/
      async:false,
      success: function(data){
             
             $('#componente option').remove();
              var opcion  = "<option value='-1'>Seleccione...</option>" ; 
              $('#componente').append(opcion); 
              for(var i=0; i < data.length ; i++) 
              {    
                    var nombre = data[i]['descripcion'];
                    var opcion  = "<option value='"+data[i]['id_componente']+"'>" +nombre+ "</option>" ; 

                    $('#componente').append(opcion); 
                                 
              }
             //$('#componente').html("");

             
            },
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
      });

}


function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Predictivo/index/<?php echo $permission; ?>");
    WaitingClose();
  }

function guardar(){     //alert("si guardo ");
       
        var equipo = $('#equipo').val();
        var tarea = $('#tarea').val();
        var periodo = $('#periodo').val();
        var fecha = $('#fecha').val();
        var cantidad = $('#cantidad').val();
        var horas = $('#horash').val();

        var parametros = {
            'id_equipo': equipo,
            'tarea_descrip': tarea,
            'fecha': fecha,
            'periodo': periodo,
            'cantidad' : cantidad,
            'horash' : horas,
            'estado': 'C'
             
        };

     //$('#sales').append(parametros);
      console.log(parametros);
      console.log("Estoy guardando");
      if(equipo >0 && tarea !=='' ){
      $.ajax({
            type: 'POST',
            data: {parametros:parametros, equipo:equipo, tarea:tarea, periodo:periodo, fecha:fecha, cantidad:cantidad, horas:horas},
            url: 'index.php/Predictivo/guardar_predictivo',  //index.php/
            success: function(data){
                   
                  console.log("exito");   
                  cargarVista();
                   
                  },
            error: function(result){
                  console.log(result);
                  //$('#modalSale').modal('hide');
                }
               // dataType: 'json'
      });
    }
      else
        {
          var hayError = true;
          $('#error').fadeIn('slow');
          return;
        }

      if(hayError == false){
        
        $('#error').fadeOut('slow');
      }
    
}

function limpiar(){
  
  $("#equipo").val("");
  $("#tarea").val("");
  $("#fecha").val("");
  $("#periodo").val("");
  $("#cantidad").val("");   

}



</script>
<!-- Datepicker -->
<script>     
  $("#fecha").datepicker({
    dateFormat: 'dd/mm/yy',
    firstDay: 1
  }).datepicker("setDate", new Date());
</script>
<!-- / Datepicker -->