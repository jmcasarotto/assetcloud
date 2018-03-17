 <input type="hidden" id="permission" value="<?php echo $permission;?>">

<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Revise que todos los campos obligatorios esten completos
    </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <h3 class="box-title">Vale de Salida Herramientas</h3>
        <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="listado">Ver Listado</button>';
          }
          ?>
        </div><!-- /.box-header -->


        <div class="box-body">
          <!-- form  -->
          <form class="form-horizontal" role="form" id="form_order" action="" accept-charset="utf-8">

            <!-- fecha y comprobante -->
            <div class="pull-right "> 
              <div class="form-group">
                <label for="comprobante" class="col-sm-6 control-label">Comprobante</label>
                <div class="col-sm-6">
                  <input type="text" name="comprobante" class="form-control comprobante" id="comprobante">
                </div>
              </div>
              <div class="form-group">
                <label for="fecha" class="col-sm-6 control-label">Fecha</label>
                <div class="col-sm-6">
                  <input type="text" name="fecha" class="form-control fecha" id="fechaOrden">
                </div>
              </div>
            </div>  
            <div class="clearfix"></div>
            <!-- / fecha y comprobante -->
            
            <style>
                p.titulos{
                  margin-left: 2%;
                  margin-bottom: -1% !important;
                  margin-top: 3%;
                }
                .icotitulo{margin-right: 5px;}
                .panel,.panel-default{padding-bottom: 17px;}
                .botones{margin-left: 27px;}
                #rowdetalle{margin-left: 26px;}
                .hidenn{display: none;}
                input.form_equipos{border: none; padding-left: 15px;}
            </style>

            <div class="row">
              <table class="table table-condensed table-responsive" id="tabequip">
                      <thead>
                        <tr>
                          <th width="2%"></th>                          
                          <th>Responsable</th>
                          <th>Destino</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label ></label></td>                           
                          <td><input type="text" name="respons" class="respons" id="respons" value="" placeholder=""></td>
                          <td><input type="text" name="dest" class="dest" id="dest" value="" placeholder=""></td>
                        </tr>
                      </tbody>
                    </table>
            </div>


            <div role="tabpanel" class="tab-pane" id="herramientas">
              <!--  ORDEN DE HERRAMIENTAS   -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><span class="fa fa-file-text-o icotitulo" aria-hidden="true"></span>Orden de Herramientas</div>
                        <p class="titulos">Detalle</p>
                        <hr>                        
                        <br />
                         <table class="table table-condensed table-responsive tablaherram">
                          <thead>
                            <tr>
                              <th width="2%"></th>
                              <th>Herramienta</th>
                              <th>Marca</th>
                              <th>Código</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><label ></label></td>                      
                              <td><input type="text" class="herramienta" id="herramienta" value="" placeholder="Buscar..."></td>                      
                              <td><input type="text" class="marcaherram" id="marcaherram" value="" placeholder=""></td>
                              <td><input type="text" class="codherram" id="codherram" value="" placeholder=""></td>
                              <td class="hidden"><input type="text" name="herrId" class="herrId" id="herrId" value="" placeholder="" disabled></td>
                            </tr>
                          </tbody>
                        </table>

                        <button type="button" class="botones btn btn-success btn-sm" onclick="javascript:armartablistherr()">Agregar</button>
                        <br/><br/>

                        <table class="table table-condensed table-responsive tablalistherram" id="tablalistherram">
                          <thead>
                            <tr>
                              <th width="2%"></th>
                              <th>Herramienta</th>
                              <th>Marca</th>
                              <th>Código</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table><br /><br />
                    </div>
            </div>

          </form>      


              <div class="pull-right">
                <button type="button" class="botones btn btn-primary" onclick="javascript:enviarOrden()">Guardar</button> 
              </div>           

          
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


<!-- Carga vista Orden de Servicio -->
<script>
 $('#listado').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Order/index/<?php echo $permission; ?>");
    WaitingClose();
  });
</script>
<!-- / Carga vista Orden de Servicio -->

<!-- Datepicker -->
<script>     
  $("#fechaOrden").datepicker({
    dateFormat: 'dd/mm/yy',
    firstDay: 1
  }).datepicker("setDate", new Date());
</script>
<!-- / Datepicker -->



<!-- Trae Herrammientas -->
<script>
  $( function() {
      var dataF = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': "Order/getHerramienta",
              'success': function (data) {
                  tmp = data;
              }
          });
          return tmp;
      }();

      $(function() {
          $(".herramienta").autocomplete({
              source: dataF,
              delay: 100,
              minLength: 1,
              focus: function(event, ui) {
                  // prevent autocomplete from updating the textbox
                  event.preventDefault();
                  // manually update the textbox
                  $(this).val(ui.item.label);
              },
              select: function(event, ui) {
                  // prevent autocomplete from updating the textbox
                  event.preventDefault();
                  // manually update the textbox and hidden field
                  $(this).val(ui.item.label);
                  $(".marcaherram").val(ui.item.value);
                  $(".codherram").val(ui.item.codherram);
                  $(".herrId").val(ui.item.herrId);
                  console.log("id de herramienta: ");
                  console.log(ui.item.herrId);
                  
              }
          });
      });
  });
</script>
<!-- Trae Herrammientas -->

<!-- Tablas armado -->
<script>

// HERRAMIENTAS
  var regHerr = 0;                // variable incrementable en func, para diferenciar los inputs
  function armartablistherr(){   // inserta valores de inputs en la tabla 

    var $herramienta = $("#herramienta").val();
    var $marcaherram = $("#marcaherram").val();
    var $codherram = $("#codherram").val(); 
    var $herrId = $("#herrId").val();
    $(".tablalistherram tbody").append(
                  '<tr>'+ 
                    '<td><i class="fa fa-ban eliminrow" style="color: #f39c12; cursor: pointer; margin-left: 15px;"></i></td>'+
                     '<td>'+ $herramienta +'</td>'+
                     '<td>'+ $marcaherram +'</td>'+
                     '<td>'+ $codherram +'</td>'+
                     '<td class="hidden" id=""><input type="text" name="herrid'+ '['+ regHerr+']' +'" class="herrid" id="herrid" value=" '+ $herrId +' " placeholder=""></td>'+
                  '<tr>');
    $("#herramienta").val("");
    $("#marcaherram").val("");
    $("#codherram").val("");
    $("#herrId").val(); 

    regHerr++;
  }
   
   // Evento que selecciona la fila y la elimina 
   $(document).on("click",".eliminrow",function(){
      var parent = $(this).closest('tr');
      $(parent).remove();
   });

</script>

<!-- Validacion de campos y Envio form -->
<script>

function enviarOrden() {  

    
  /////  VALIDACIONES

  var hayError = false;    
  

  if(hayError == true){
     $('#error').fadeIn('slow');
     return;
  }
  else{
      $('#error').fadeOut('slow');
      var id_equipo = $("#numSolic").val();
      var datos = $("#form_order").serializeArray();
      // console.log("Orden array serializado");
      // console.log(datos);

      WaitingOpen('Guardando cambios');
      $.ajax({    
                  data: datos,
                  type: 'POST',             
                  dataType: 'json',
                  url: 'index.php/Order/setHerramienta',
                  //url: 'index.php/Ordenservicio/setOrdenServ',                
                  success: function(result){
                                                    
                          WaitingClose();
                          //setTimeout("cargarView('Ordenservicio', 'index', '"+$('#permission').val()+"');",0);
                          alert("Guardado con exito...");
                  },
                  error: function(result){
                          WaitingClose();
                          //setTimeout("cargarView('Ordenservicio', 'index', '"+$('#permission').val()+"');",0);
                          //cargarView('Ordenservicio', 'index', '"+$('#permission').val()+"');
                          
                          alert("Error en guardado...");
                  },
            });
      }    
}
</script>
<!-- / Validacion de campos y Envio form -->