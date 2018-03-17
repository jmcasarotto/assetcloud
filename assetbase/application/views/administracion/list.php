<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orden de trabajo</h3>
          <?php
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="otrabajo" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Nro</th>
                <th>Fecha</th>
                <th>Fecha Entrega</th>
                <th>Fecha Terminada </th>
                <th>Detalle </th>
                <th>Cliente </th>
                <th>Solicita </th>
                <th>Asignado </th>
                <th>Estado </th>

              </tr>
            </thead>
            <tbody>
              <?php

                if(count($list) > 0) { 
         

                  $userdata = $this->session->userdata('user_data');
                  $usrId= $userdata[0]['usrId']; 
               	  foreach($list as $a){

                    if(($a['estado'] !=='T') && ($a['estado'] !=='E') && ($a['estado'] !=='TE')) {
                   
                      $id=$a['id_orden'];

                      echo '<tr id="'.$id.'" class="'.$id.'">';
      	               
                        echo '<td>'; 
                          if (strpos($permission,'Add') !== false) { //Entregar
                            echo '<i class="fa fa-sticky-note" style="color:  #A4A4A4; cursor: pointer; margin-left: 15px;"  title="ver Orden de Perdido " ></i>';
                            echo '<i class="fa fa-clone " style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Ver Nota Pedido" data-toggle="modal" data-target="#modallista"></i>'; 
                          }                            
      	                echo '</td>';

                        echo '<td style="text-align: right">'.$a['nro'].'</td>';
      	                echo '<td style="text-align: left">'.$a['fecha_inicio'].'</td>';
                        echo '<td style="text-align: right">'.$a['fecha_entrega'].'</td>';
                        echo '<td style="text-align: right">'.$a['fecha_terminada'].'</td>';
                        echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                        echo '<td style="text-align: left">'.$a['cliLastName'].' , '.$a['cliName'].'</td>';
                        echo '<td style="text-align: right">'.$a['usrName'].'</td>';
                        echo '<td style="text-align: right">'.$a['nombre'].'</td>';
                        echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' : ($a['estado'] == 'P' ? '<small class="label pull-left bg-red">Pedido</small>' : ($a['estado'] == 'As' ? '<small class="label pull-left bg-yellow">Asignado</small>' : '<small class="label pull-left bg-blue">Terminado</small>'))).'</td>';
    	                echo '</tr>';
                    
      		          }
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
var iort= "";
var ido ="";
var idp ="";
var idArt = 0;
var acArt = '';
var i ="";
var idord ="";
var idfin= "";
$(document).ready(function(event) {
  
  //Al apretar la opcion asignar tareas , esto lleva a esa pantalla, esto es lo que hay q cambiar para subir
  $(".fa-sticky-note").click(function (e) { 
    var id = $(this).parent('td').parent('tr').attr('id');
    console.log("El id de OT es:");
    console.log(id);
    iort= id;
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Administracion/cargartarea/<?php echo $permission; ?>/"+iort+"");
    WaitingClose();  
  });

  // lleva a pantalla listado de articulos nota de pedido
  $('.fa-clone').click( function cargarVista(){

      var $id_nota = $(this).parent('td').parent('tr').attr('id');    
      WaitingOpen();
      $('#content').empty();
      $("#content").load("<?php echo base_url(); ?>index.php/Pedido/ArtListPorIdNota/<?php echo $permission; ?>/"+ $id_nota +"");
      WaitingClose();
  });
 

  $('#otrabajo').DataTable({
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

<!-- Modal mostrar pedido-->
<div class="modal fade" id="modallista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 70%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-truck" style="color: #3c8dbc" > </span> Lista de Orden de Pedido</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <form id="tblremito">
              <div class="form-group">
                <label for="numremito">Ingrese el Nº de Remito</label>
                <input type="text" class="form-control" id="numremito" placeholder="Numero remito...">
              </div>
              <div id="texto" style="display:none">Algun input está checkeado</div>
              <br><br>
              <table class="table table-bordered table-hover" id="tabladetalle">
                <thead>
                  <tr>   
                    <th>Id Orden</th>                                 
                    <th>Id Orden</th>
                    <th>Nota Pedido</th>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>F. Entrega</th>
                    <th>F. Entregado</th>
                    <th>Proveedor</th>                  
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>              
                </tbody>
              </table>
            </form>    
          </div>
        </div>  
      </div>  <!-- /.modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSave" onclick="tableToArray()">Guardar</button>

      </div>
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->




