<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Informe de Servicio</h3> <!-- EX Orden de Servicios-->
          
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tblorden" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="15%">Acciones</th> 
                <th style="text-align: center">Nº Solicitud</th>             
                <!-- <th style="text-align: center">Nº Solicitud</th> -->
                <th style="text-align: center">Fecha de Solicitud</th>                
                <th style="text-align: center">Falla</th>
                <th style="text-align: center">Fecha de Solicitud</th>                
                <th style="text-align: center">Solicitante</th>
                <th style="text-align: center">Estado</th>                          
              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list) > 0) {                  
                	foreach($list as $a){
      		        
  	                $id=$a['id_orden'];
                    echo '<tr id="'.$id.'">';                    
                    echo '<td class="icono">';                    
                    echo '<i class="fa fa-sticky-note-o" data-toggle="modal" data-target="#modalOrder" style="color: #006400; cursor: pointer; margin-left: 15px;" title="Ver Informe"></i>';                      
                     echo '<i class="fa fa-fw '.($a['estado'] == 'C' ? 'fa fa-toggle-on' : 'fa fa-toggle-off').' title="Finalizar Informe" style="color: #006400; cursor: pointer; margin-left: 15px;"></i>';

                     echo '</td>';
                      //echo '<td style="text-align: center">'.$a['id_orden'].'</td>';  	    
                      echo '<td style="text-align: center">'.$a['id_solicitud'].'</td>';            
                      echo '<td style="text-align: center">'.$a['f_solicitado'].'</td>';
                      echo '<td style="text-align: center">'.$a['causa'].'</td>';
                      echo '<td style="text-align: center">'.$a['fecha'].'</td>';
                      echo '<td style="text-align: center">'.$a['solicitante'].'</td>';
                      echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' :($a['estado'] == 'T' ? '<small class="label pull-left bg-blue">Terminado</small>' : '<small class="label pull-left bg-red">Solicitado</small>')).'</td>';
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


<!-- Modal Ver -->           
<div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                          <!-- EX Orden de Servicios-->
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Informe de Servicio</h4>
      </div> <!-- /.modal-header  -->  
       
      <div class="modal-body">  
        <table id="modOrden" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <!-- <th width="5%">Acciones</th> --> 
                  <th style="text-align: center">Nº Orden</th>             
                  <th style="text-align: center">Nº Solicitud</th>
                  <th style="text-align: center">Fecha de Solicitud</th>                
                  <th style="text-align: center">Falla</th>
                  <th style="text-align: center">Fecha de Orden</th>                
                  <th style="text-align: center">Solicitante</th>
                  <th style="text-align: center">Estado</th>               
                </tr>
              </thead>
              <tbody>
              </tbody>
        </table>      
       
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a class="tarea"role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Tareas
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <table id="modTarea" class="table table-bordered table-hover">
                        <thead>
                          <tr>                            
                            <th style="text-align: left">Tareas</th>             
                            <th style="text-align: left">Componenetes</th>
                            <th style="text-align: left">Horas</th>                
                            <th style="text-align: left">Monto</th>                                          
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table> 
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                  <a class="herramientas collapsed" id="herramientas" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Orden de Herramientas
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <table id="modHerram" class="table table-bordered table-hover">
                        <thead>
                          <tr>                            
                            <th style="text-align: left">Herramientas</th>             
                            <th style="text-align: left">Marcca</th>
                            <th style="text-align: left">Código</th>     
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                  <a class=" insumos collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Orden de Insumos
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                 <table id="modInsum" class="table table-bordered table-hover">
                        <thead>
                          <tr>                            
                            <th style="text-align: left;">Artículo</th>             
                            <th style="text-align: left;">Cantidad</th>
                            <th style="text-align: left;">Depósito</th>                                       
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                  <a class=" insumos collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Recursos Humanos
                  </a>
                </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                 <table id="modRecurso" class="table table-bordered table-hover">
                        <thead>
                          <tr>                            
                            <th style="text-align: left;">Apellido y Nombre</th> 
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div> <!-- / .panel-group -->


      </div> <!-- /.modal-body -->

      <div class="modal-footer">                    
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
      </div>  <!-- /.modal footer -->
    
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Resetea Nº de orden al recargar la pagina -->
<script>
 $('#cargOrden').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Ordenservicio/getOrdenInactiva/<?php echo $permission; ?>");
    WaitingClose();
  });
</script>
<!-- / Resetea Nº de orden al recargar la pagina -->




<!-- Cambia el estado de solicitud de servicio  -->
<script>   
  $(".fa-thumbs-up").click(function () {  

    var id_solServ = $(this).parent('td').parent('tr').attr('id'); // guarda el id de orden en var global id_solServ
    $.ajax({
          type: 'POST',
          data: {id_solServ: id_solServ},
          url: 'index.php/Ordenservicio/setEstado', 
          success: function(data){                   
                   setTimeout("cargarView('Ordenservicio', 'index', '"+$('#permission').val()+"');",0);
                },            
          error: function(result){
                alert("Error en cambio de estado");
              },
              dataType: 'json'
          });
  });
</script>
<!-- / Cambia el estado de Orden servicio y de solicitud de servicio  -->

















<!-- Cambia el estado de Orden servicio y de solicitud de servicio  -->
<script>   
  $(".fa-toggle-on").click(function () {  

    var id_orden = $(this).parent('td').parent('tr').attr('id'); // guarda el id de orden en var global id_orden
    $.ajax({
          type: 'POST',
          data: {id_orden: id_orden},
          url: 'index.php/Ordenservicio/setEstado', 
          success: function(data){                   
                   setTimeout("cargarView('Ordenservicio', 'index', '"+$('#permission').val()+"');",0);
                },            
          error: function(result){
                alert("Error en cambio de estado");
              },
              dataType: 'json'
          });
  });
</script>
<!-- / Cambia el estado de Orden servicio y de solicitud de servicio  -->



<script>  
  
  /////// Carga la tabla del Modal y valida que  no se duplique 
  var $flag = 0;    
  $(".fa-sticky-note-o").click(function () {     

    var row = $(this).parent("td").parent("tr").clone();
   //row.eq(0).css({"display:none"});
   row.find('td.icono').remove();
    
    var id_ord = row.attr('id'); // guardo el Id de la orden de servicio.
    console.log('id de orden');
    console.log(id_ord);

    if ($flag == 0) {     //primera vez
        mostrarOrd(row); 
        getTarOrden(id_ord);
        getHerrramOrden(id_ord);
        getInsumOrd(id_ord);
        getRecOrden(id_ord);             
        $flag = 1;
    } 
    else{     //mas de una vez
        $("#modOrden tbody tr").remove();
        $("#modTarea tbody tr").remove();
        $("#modHerram tbody tr").remove();
        $("#modInsum tbody tr").remove();
        $("#modRecurso tbody tr").remove();
        mostrarOrd(row);  
        getTarOrden(id_ord);
        getHerrramOrden(id_ord);
        getInsumOrd(id_ord);  
        getRecOrden(id_ord);      
        $flag = 1;
    };
  });
</script>

<script>
   
  //// muestra el encabezado de la Orden de servicio en Modal
  function mostrarOrd(row){

    $("#modOrden tbody").append(row);      
  }

  //// trae tareas segun id de orden y arma tabla en modal 
  function getTarOrden(id_ord){
    //console.log('id de orden en funcion get tareas');
    //console.log(id_ord);
    var dataF = function () {
        var tmp = null;
        $.ajax({
                  'data' : {id_orden:id_ord },// viene de variable global id_orden.
                  'async': false,
                  'type': "POST",
                  'global': false,
                  'dataType': 'json',
                  'url': "Ordenservicio/getTareaOrden",
                  'success': function (data) {
                      tmp = data;
                  }
              });
              return tmp;
        }();  

      // Asigna opciones al select #tareas      
      var tblTareas= $("#modTarea");
      $.each(dataF, function(i, val){           
          tblTareas.append(
              '<tr>'+                     
                     '<td>'+ val.descripcion +'</td>'+
                     '<td>'+ val.componente +'</td>'+
                     '<td>'+ val.horas +'</td>'+
                     '<td>'+ val.monto +'</td>'+                     
              '<tr>'
          )
      });
  }

  //// trae herramientas segun id de orden y arma tabla en modal 
  function getHerrramOrden(id_ord){

      var dataF = function () {
          var tmp = null;
          $.ajax({
                    'data' : {id_orden:id_ord },
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': "Ordenservicio/getHerramOrden",
                    'success': function (data) {
                        tmp = data;
                    }
                });
                return tmp;
          }();        
      
      var tblHerram= $("#modHerram"); 
      $.each(dataF, function(i, val){           
            tblHerram.append(
                '<tr>'+                     
                       '<td>'+ val.herrdescrip +'</td>'+
                       '<td>'+ val.herrmarca +'</td>'+
                       '<td>'+ val.herrcodigo +'</td>'+                                         
                '<tr>'
            )
      });
  }

  //// trae Insumos segun id de orden y arma tabla en modal 
  function getInsumOrd(id_ord){

      var dataF = function () {
          var tmp = null;
          $.ajax({
                    'data' : {id_orden:id_ord },
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': "Ordenservicio/getInsumOrden",
                    'success': function (data) {
                        tmp = data;
                    }
                });
                return tmp;
          }();        
      
      var tblHerram= $("#modInsum"); 
      $.each(dataF, function(i, val){           
            tblHerram.append(
                '<tr>'+                     
                       '<td>'+ val.descripcion +'</td>'+
                       '<td>'+ val.cantidad +'</td>'+
                       '<td>'+ val.deposito +'</td>'+                                         
                '<tr>'
            )
      });
  }

  //// trae RRHH segun id de orden y arma tabla en modal 
  function getRecOrden(id_ord){

     $.ajax({
                  'data' : {id_orden:id_ord },// viene de variable global id_orden.
                  'async': false,
                  'type': "POST",
                  'global': false,
                  'dataType': 'json',
                  'url': "Ordenservicio/getOperarioOrden",
                  'success': function (data) {
                      
                      var tblRecursos= $("#modRecurso tbody");   
                      
                      $.each(data, function(clave,valor){ 
                      tblRecursos.append(
                          '<tr>'+                     
                                 '<td>'+ valor.operario +'</td>'+                               
                          '<tr>'
                          );
                      });

                  },
                  'error': function (data){
                    console.log('operarios en error');
                    console.log(data['operario']);
                    alert('Error en ajax');
                  }
      });      
  }

</script>

<script>
$(document).ready(function(event){    
    $('#tblorden').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "language": {
                "lengthMenu": "Ver _MENU_ filas por página",
                "zeroRecords": "No hay registros",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
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
     

</script>
