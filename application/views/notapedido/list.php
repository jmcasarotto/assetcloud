<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Nota de Pedido</h3>
          <?php
            if (strpos($permission,'Add') !== false) {
              echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="btnAdd">Agregar</button>';
            }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="deposito" class="table table-bordered table-hover" style="text-align: center">
            <thead>
              <tr>
                <th width="20%" style="text-align: center">Acciones</th>
                <th style="text-align: center">Orden de Trabajo</th>
                <th style="text-align: center">Detalle</th>
                <th style="text-align: center">Fecha Nota</th>              
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($list as $z)
                {
                  $id=$z['id_notaPedido'];
                
                    echo '<tr id="'.$id.'" class="'.$id.'" >';
                    echo '<td>';
                  // if (strpos($permission,'Edit') !== false) {
                  //     echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar"></i>';
                  // }
                  // if (strpos($permission,'Del') !== false) {
                  //     echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;"></i>';
                  // } 
                  if (strpos($permission,'View') !== false) {
                    echo '<i class="fa fa-fw fa-search" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" title="Ver Nota Pedido" data-toggle="modal" data-target="#modaltarea"></i>';
                  }                     
                  echo '</td>';
                  echo '<td style="text-align: center">'.$z['id_ordTrabajo'].'</td>';
                  echo '<td style="text-align: center">'.$z['descripcion'].'</td>';
                  echo '<td style="text-align: center">'.$z['fecha'].'</td>';
                  // echo '<td style="text-align: center">'.$z['marcadescrip'].'</td>';
                  // echo '<td style="text-align: center">'.$z['depositodescrip'].'</td>';

                  // echo '<td style="text-align: center">'.($z['equip_estad']  == 'AC' ? '<small class="label pull-left bg-green" >Activa</small>' :'<small class="label pull-left bg-blue">Transito</small>').'</td>';

                  echo '</tr>';
                  
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
var ed="";
$(document).ready(function(event) {
  //Agregar nota
  $('#btnAdd').click( function cargarVista(){
        WaitingOpen();
        $('#content').empty();
        $("#content").load("<?php echo base_url(); ?>index.php/Notapedido/agregarNota/<?php echo $permission; ?>");
        WaitingClose();
  });
  //Editar
  $(".fa-pencil").click(function (e) { 

      console.log ("entre");
      var idh = $(this).parent('td').parent('tr').attr('id');
      console.log("ID de herramienta es ");
      console.log(idh);
     // alert(idh);
      ed=idh;
      $.ajax({
          type: 'GET',
          data: { idh:idh},
          url: 'index.php/Herramienta/getpencil', //index.php/
          success: function(data){
                    console.log("Estoy editando");
                    console.log(data);
                     console.log(data[0]['modid']);             
                    datos={
               
                        'codigode':data[0]['herrcodigo'],
                        'descripcionde':data[0]['herrdescrip'],
                        'modid':data[0]['modid'],
                        'depositoid':data[0]['depositoId'],
                        'marcade':data[0]['herrmarca'], 
                        'descrip': data[0]['depositodescrip'],
                        'descripmarca' : data[0]['marcadescrip'],
                        'descripdepo' : data[0]['depositodescrip'],
                  }
                completarEdit(datos);
                            
                },
            
         error: function(result){
                
                console.log(result);
              },
              dataType: 'json'
          });
  
  });

  //Eiminar
  $(".fa-times-circle").click(function (e) {                 
         
    console.log("Esto eliminando"); 
    var id_herr = $(this).parent('td').parent('tr').attr('id');
    console.log(id_herr);
    
    $.ajax({
            type: 'POST',
            data: { id_herr: id_herr},
            url: 'index.php/Herramienta/baja_herramienta', //index.php/
            success: function(data){
                    //var data = jQuery.parseJSON( data );
                    console.log(data);
                   
                    //$(tr).remove();
                    alert("HERRAMIENTA Eliminado");
                    regresa();
                  
                  },
              
            error: function(result){
                  
                  console.log(result);
                },
                dataType: 'json'
      });
  });
  
  //Ver Orden
  // $(".fa-search").click(function (e) { 
      
  //     var id_nota = $(this).parent('td').parent('tr').attr('id');
  //     console.log(id_nota);
      
  //     $.ajax({
  //             type: 'POST',
  //             data: { id: id_nota},
  //             url: 'index.php/Notapedido/getNotaPedidoId', //index.php/
  //             success: function(data){
  //                     //$('tr.celdas').remove();
  //                     for (var i = 0; i < data.length; i++) {            
  //                        var tr = "<tr class='celdas'>"+
  //                                //"<td ></td>"+
  //                                "<td>"+data[i]['artDescription']+"</td>"+
  //                                "<td>"+data[i]['cantidad']+"</td>"+                               
  //                                "<td>"+data[i]['fecha']+"</td>"+
  //                                "<td>"+data[i]['fechaEntrega']+"</td>"+
  //                                "<td>"+data[i]['fechaEntredado']+"</td>"+
  //                                "<td>"+data[i]['estado']+"</td>"+                               
  //                                "</tr>";
  //                        $('#tabladetalle tbody').append(tr);
  //                      }
  //                   },
                
  //             error: function(result){
                    
  //                   console.log(result);
  //                 },
  //                 dataType: 'json'
  //     });
  // });


  //Ver Orden
  $(".fa-search").click(function (e) { 
      
      var id_nota = $(this).parent('td').parent('tr').attr('id');
     
      $.ajax({
              type: 'POST',
              data: { id: id_nota},
              url: 'index.php/Notapedido/getNotaPedidoId',
              success: function(data){

                      $('tr.celdas').remove();
                      for (var i = 0; i < data.length; i++) {            
                         var tr = "<tr class='celdas'>"+
                                 "<td>"+data[i]['artDescription']+"</td>"+
                                 "<td>"+data[i]['cantidad']+"</td>"+
                                 "<td>"+data[i]['fecha']+"</td>"+ 
                                 "<td>"+data[i]['fechaEntrega']+"</td>"+ 
                                 "<td>"+data[i]['fechaEntregado']+"</td>"+     
                                 "<td>"+data[i]['provnombre']+"</td>"+                                 
                                 "<td>"+data[i]['estado']+"</td>"+                             
                                 "</tr>";
                         $('#tabladetalle tbody').append(tr);
                      }
                    },                
              error: function(result){
                    
                    console.log(result);
                  },
                  dataType: 'json'
      });
  });

  $('#deposito').DataTable({
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


function regresa(){

  //WaitingOpen();
  //$('#modaldeposito').empty();
  //$('#modaleditar').empty(); 
  //$('#content').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Herramienta/index/<?php echo $permission; ?>");
   WaitingClose();
}

  

</script>


<!-- Modal ver nota pedido-->
 <div class="modal fade" id="modaltarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #008000" > </span> Ver Nota de Pedido</h4>
      </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
             <table id="tabladetalle" class="table table-bordered table-hover">
               <thead>
                  <tr>
                    <th width="20%" style="text-align: center">Articulo</th>
                    <th style="text-align: center">Cantidad</th>                    
                    <th style="text-align: center">Fecha Nota</th>
                    <th style="text-align: center">Fecha de Entrega</th>
                    <th style="text-align: center">Fecha Entregado</th>
                    <th style="text-align: center">Proveedor</th>
                    <th style="text-align: center">Estado</th>                  
                  </tr>
                </thead>
               <tbody>
                 
               </tbody>
             </table>             
          </div>
        </div>
      </div>
      <div class="modal-footer">       
        <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal">Ok</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

