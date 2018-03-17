<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Listado de Ordenes de pedidos</h3>
          <?php

          echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="listado">Ver Listado</button>';


          ?>
                     
        </div><!-- /.box-header -->
        <div class="box-body">
        
        <div class="col-sm-12 col-md-12">
         <label >Número de Orden de trabajo:      
          <input type="text"  id="numord" name="numord" value="<?php echo $id_orden;?>" class="border-none" > </input>
       </label> 
        <br> 
          <table id="otrabajo" class="table table-bordered table-hover">
            <thead>
              <tr>
               <th width="10%">Acciones</th>                  
                  <th>Nro de orden</th>
                  <th>Fecha</th>
                  <th>Fecha de Entrega</th>
                  <th>Proveedor</th>
                  <th>Descripcion</th>
                  <th>Estado</th>

              </tr>
            </thead>
            <tbody>
            <br>
            <br>
              <?php

                if(count($list) > 0) { 

                  $userdata = $this->session->userdata('user_data');
                  $usrId= $userdata[0]['usrId']; 
               	  foreach($list as $a){

                     if ($a['estado'] =='P'){
                   
                      $id=$a['id_orden'];
                      $idt=$a['id_trabajo'];
                      echo '<tr id="'.$id.'" class="'.$idt.'">';
    	                echo '<td>';

                     

                      if (strpos($permission,'Add') !== false) { //Entregar

                       
                        echo '<i class="fa fa-check-circle-o" style="color: #006400; cursor: pointer; margin-left: 15px;"  title="Entregar Pedido " data-toggle="modal" data-target="#modalpedido"></i>';
                      }
                     
                 
                          
    	                echo '</td>';
                      echo '<td style="text-align: center">'.$a['nro_trabajo'].'</td>';
    	                echo '<td style="text-align: center">'.$a['fecha'].'</td>';
                      echo '<td style="text-align: center">'.$a['fecha_entrega'].'</td>';
                      echo '<td style="text-align: center">'.$a['provnombre'].'</td>';
                      echo '<td style="text-align: center">'.$a['descripcion'].'</td>';
                      echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' : ($a['estado'] == 'P' ? '<small class="label pull-left bg-red">Pedido</small>' : ($a['estado'] == 'As' ? '<small class="label pull-left bg-yellow">Asignado</small>' : '<small class="label pull-left bg-blue">Terminado</small>'))).'</td>';
    	                echo '</tr>';
                    
      		          }
                  }

                }
              ?>
            </tbody>
          </table>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<style type="text/css">
  .border-none { border: 0 }
</style>
<script>
var iort= "";
var no="";

$(document).ready(function(event) {
  
  //Al apretar la opcion asignar tareas , esto lleva a esa pantalla, esto es lo que hay q cambiar para subir
  $(".fa-check-circle-o").click(function (e) { 
    var id = $(this).parent('td').parent('tr').attr('id');
    console.log("El id de Opedido es:");
    console.log(id);
    iort= id;
   
  });

    $('#listado').click( function cargarVista(){
      var numord= $('#numord').val();
      no=numord;
      console.log(no);
      WaitingOpen();
      $('#content').empty();
     
       $("#content").load("<?php echo base_url(); ?>index.php/Administracion/index/<?php echo $permission; ?>");

       WaitingClose();
  });


 /* $(".fa-truck").click(function (e) { 

   $("#modallista tbody tr").remove();
    var idorde = $(this).parent('td').parent('tr').attr('id');
    
    //idord= idorde;
    console.log("ID de orden de trabajo para mostrar pedido es :");
    console.log(idorde); 
    ido=idorde;   
    $.ajax({
        type: 'POST',
        data: { idorde:idorde},
        url: 'index.php/Otrabajo/getmostrar', //index.php/
          success: function(data){
            console.log("llego el detalle");
            console.log(data);
           
            for (var i = 0; i < data.length; i++) {

              if (data[i]['estado']== 'P'){
              var estado= '<small class="label pull-left bg-green">Pedido</small>';
              }
              else 
                if (data[i]['estado']== 'C'){
                var estado= '<small class="label pull-left bg-blue">Curso</small>';
                }
                else
                  if (data[i]['estado']== 'E'){ 
                  var estado= '<small class="label pull-left bg-red">Entregado</small>';
                  }
                    else{ 
                      var estado= '<small class="label pull-left bg-yellow">Terminado</small>';
                    }
              var tr = "<tr >"+
                      "<td ></td>"+
                      "<td>"+data[i]['nro_trabajo']+"</td>"+
                      "<td>"+data[i]['fecha']+"</td>"+
                      "<td>"+data[i]['fecha_entrega']+"</td>"+
                      "<td>"+data[i]['provnombre']+"</td>"+
                      "<td>"+data[i]['descripcion']+"</td>"+
                      "<td>"+estado+"</td>"+
                      "</tr>";
              $('#tabladetalle tbody').append(tr);

            }
            console.log(tr);

          },
            
          error: function(result){
                console.log("Entro x el error de detalle");
                
                console.log(result);
              },
              dataType: 'json'
    });
    
  });
*/




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


function guardarpedido(){

  console.log("guardo remito y cambio estado");
 
  var numero = $('#num1').val();
  //idoes el id de orden_pedido

  console.log("el id de orden de pedido es: ");
  console.log(iort);
  console.log(numero);
  $.ajax({
        type: 'POST',
        data: {numero:numero, iort:iort},
        url: 'index.php/Administracion/agregar_pedido',  //index.php/
        success: function(data){
                console.log("Estoy guardando pedido");
                regresa();
               
              },
        error: function(result){
              
              console.log(result);
             
           }
           // dataType: 'json'
  });                 
}    

//Refresca    
function regresa(){

 
  var numord= $('#numord').val();
  no=numord;
  console.log("El id de OT es:");
  console.log(no);
    
  $("#content").load("<?php echo base_url(); ?>index.php/Administracion/cargartarea/<?php echo $permission; ?>/"+no+"");
      
}     
     
  
// function regresa1(){
  
//     $('#content').empty();
//     $('#modalOT').empty();
//     $('#modalAsig').empty();
//     $("#content").load("<?php //echo base_url(); ?>index.php/Administracion/cargartarea/<?php// echo $permission; ?>");
//     WaitingClose();
//     WaitingClose();
// }


</script>


<!-- Modal Pedido-->
<div class="modal fade" id="modalpedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 35%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-check-circle-o" style="color: #006400" > </span> Número de remito </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <fieldset> </fieldset>
            
            <div class="col-xs-12">
              <input type="text"  class="form-control" id="num1" name="num1" placeholder="Ingrese nro de remito...">
              <!--align=\"right\" -->
            </div>
           
          </div>
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal" onclick="guardarpedido()" >Guardar</button>
        </div>  <!-- /.modal footer -->
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->


