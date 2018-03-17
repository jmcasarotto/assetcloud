
<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
 
 
 <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Administrador de Ordenes</h3>
         
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="envio" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>ID</th>
                <th>Numero</th>
                <th>Fecha Inicio</th>
                <th>Fecha Entrega</th>
                <th>Fecha Terminada</th>
                <th>Fecha Aviso</th>
                <th>Detalle</th>
                <th>Estado</th>

              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list) > 0) {                  
                  foreach($list as $a) { 

                    if ($a['estado'] == 'T' || $a['estado'] == 'TE'){
                    
                    $id=$a['id_orden'];
                    echo '<tr id="'.$id.'">';
                    echo '<td style="text-align: center">';
                    if (strpos($permission,'Edit') !== false) {
                                        
                    //if (strpos($permission,'Finalizar') !== false) {
                      //echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" title="Eliminar"></i>'; 
                      if ($a['estado'] == 'T'){
                      echo '<i class="fa fa-thumbs-up" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" title="Entregar"></i>';
                      
                     } 
                      if ($a['estado'] == 'TE'){

                        echo '<i class="fa fa-calendar cous" style="color: #A9A9A9 ; cursor: pointer;"" title="Reprogramación" data-toggle="modal" data-target="#modalfecha" ></i>';
                      } 
                    }
                    
                    echo '</td>';
                    //if ($a['estado'] == 'T') {
                     
                    echo '<td style="text-align: right">'.$a['id_orden'].'</td>';
                    echo '<td style="text-align: right">'.$a['nro'].'</td>';
                    echo '<td style="text-align: left">'.date_format(date_create($a['fecha_inicio']), 'd-m-Y').'</td>';
                    echo '<td style="text-align: right">'.date_format(date_create($a['fecha_entrega']), 'd-m-Y').'</td>';
                    echo '<td style="text-align: right">'.date_format(date_create($a['fecha_terminada']), 'd-m-Y').'</td>';
                    echo '<td style="text-align: right">'.date_format(date_create($a['fecha_aviso']), 'd-m-Y').'</td>';
                    echo '<td style="text-align: right">'.$a['descripcion'].'</td>';


                    
                   echo '<td style="text-align: center">'.($a['estado'] == 'T' ?  '<small class="label pull-left bg-blue">Terminado</small>':($a['estado'] == 'TE' ? '<small class="label pull-left bg-red">Terminado Parcial</small>':'<small class="label pull-left bg-green">Entregado</small>')) .'</td>';  


                    /*echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' : ($a['estado'] == 'P' ? '<small class="label pull-left bg-red">Pedido</small>' : ($a['estado'] == 'T' ? '<small class="label pull-left bg-red">Terminado</small>' :'<small class="label pull-left bg-yellow">Asignado</small>'))).'</td>';*/
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

$(document).ready(function(event) {

  $(".fa-thumbs-up").click(function (e) { 
               
        //var tr = $(this).parent('td').parent('tr');

        var id_orden = $(this).parent('td').parent('tr').attr('id');
        console.log(id_orden);
       
            $.ajax({
              type: 'POST',
              data: { id_orden: id_orden},
              url: 'index.php/Envio/entrega', //index.php/
              success: function(data){
                      //var data = jQuery.parseJSON( data );
                      
                      console.log(data);
                     
                      //$(tr).remove();

                    //$('#envio').append(data); 
                     
              

                    alert("Se Entrego Orden");
                    regresa();
                    },
                
              error: function(result){
                    
                    console.log(result);
                  }
                  //dataType: 'json'
              });
        
  
  });

  $('#fecha').datepicker({
        changeMonth: true,
        changeYear: true
  }); 
  // FECHA 
  $(".fa-calendar").click(function (e) { 
      
    var idor = $(this).parent('td').parent('tr').attr('id'); 
    console.log("id de orden es:");
    console.log(idor); 
    ido=idor; 
      
  });


  $('#envio').DataTable({
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

//OT PARCIAL, pasa a la partalla de ot PARCIAL 
function guardarparcial(){

  console.log("Estoy finalizando parcial la ot ");
  console.log(idfin); 
  $.ajax({
        type: 'POST',
        data: { idfin: idfin},
        url: 'index.php/Otrabajo/CambioParcial', //index.php/
        success: function(data){
                console.log(data);
                alert("Se Finalizando PARCIAL LA ORDEN TRABAJO");
                regresa();
              },
          
        error: function(result){
              console.log(result);
            }
            //dataType: 'json'
    });
 }

function guardarfecha(){
  
  var fe= $('#fecha').val();
 
  console.log("La fechaa a guardar es :");
  console.log(fe);
  console.log("El id de orden es :");
  console.log(ido);
  $.ajax({
                type: 'POST',
                data: { ido:ido, fe:fe},
                url: 'index.php/Envio/ModificarFecha', //index.php/
                success: function(data){
                        console.log(data);
                        
                        regresa();
                      
                      },
                  
                error: function(result){
                      console.log(result);
                   }
        });

} 


function regresa(){
  
 // $('#content').empty(); //listOrden  
  $("#content").load("<?php echo base_url(); ?>index.php/Envio/index/<?php echo $permission; ?>");
 // WaitingClose();
}

</script>

<!-- Modal modalSale -->
<div class="modal fade" id="modalfecha" tabindex="2000" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog" role="document" style="width: 40%">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale" class="fa fa-user" style="color: #A9A9A9" > </span> Reprogramar</h4> 
      </div>

      <div class="modal-body" id="modalBodySale">
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <fieldset> </fieldset>
            <br>
            <div class="col-xs-6">Fecha
              <input type="text" id="fecha" name="fecha" value="<?php echo date_format(date_create(date("Y-m-d ")), 'd-m-Y') ; ?>"  class="datepicker">
            </div>
                                                        
          </div>
        </div>
      </div>       
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
        <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="guardarfecha()">Guardar</button>
      </div>

    </div>
  </div>
</div>


