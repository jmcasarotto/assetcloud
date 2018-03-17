<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <br>
          <h3 class="box-title">Asociar Componentes a Equipo</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="btnAgre">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="comp" class="table table-bordered table-hover" style="text-align: center">
            <thead>
              <tr>                
                <th width="20%" style="text-align: center">Acciones</th>
                <th style="text-align: center">Equipo</th>
                <th style="text-align: center">Descripción</th>
                <th style="text-align: center">Componente</th>   
              </tr>
            </thead>
            <tbody>
              <?php

              foreach($list as $a){  
               // var_dump($a['estado']);
                $idc=0;
                if ($a['estado'] !=='AN'){

                    $id=$a['id_equipo'];
                    $idcom= $a['id_componente'];
                    echo '<tr id="'.$id.'" class="'.$idcom.'">';
                    echo '<td>';
                    
                    if (strpos($permission,'Del') !== false) {
                      echo '<i href="#" class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar asociacion" data-toggle="modal" data-target="#modalaviso"></i>';


                      echo '</td>';
                      '<input type="hidden" id="id_equipo" name="id_equipo">';
                      echo '<td style="text-align: center">'.$a['codigo'].'</td>';
                      echo '<td style="text-align: center">'.$a['descripcion'].'</td>';
                      echo '<td id="'.$idc.'" style="text-align: center">'.$a['descomp'].'</td>';
                      $idc++;
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
var isOpenWindow = false;
var comglob="";
 var datos="";
  var idequipo="";
$(document).ready(function(event) {
     
  edit=0;  datos=Array(); 
  $('#btnAgre').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Componente/cargarcomp/<?php echo $permission; ?>");
    WaitingClose();
  });
  
 
  //Eliminar
  $(".fa-times-circle").click(function (e) {  

    console.log("ESTOY ELIMINANDO"); 
    var ide = $(this).parent('td').parent('tr').attr('id');
    idequipo=ide;
    console.log("El id de equipo es:");
    console.log(idequipo);
    var idcomp = $(this).parent('td').parent('tr').attr('class');
    console.log(idcomp);
    datos= parseInt(idcomp);
    console.log("El id de datos es:");
    console.log(datos);
                            
  });    

  $('#comp').DataTable({
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

function cargarVista(){
  
    //$('#content').empty();
   // $('#modalaviso').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Componente/index/<?php echo $permission; ?>");
  //  WaitingClose();
    //WaitingClose();

}
    
function regresa(){

  $('#modalSale').empty();
  $('#modalbaja').empty(); 
  $('#content').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Equipo/index/<?php echo $permission; ?>");
 WaitingClose();
 

}

function cerro(){
    
    isOpenWindow = false;
}

function eliminar(){

  //var idpre = $(this).parent('td').parent('tr').attr('id');
  console.log("Estoy por la opcion SI a eliminar")
  console.log(idequipo);
  console.log(datos);
          
  $.ajax({
          type: 'POST',
          data: { idequipo: idequipo,datos: datos},
          url: 'index.php/Componente/baja_comp', //index.php/
          success: function(data){
                  //var data = jQuery.parseJSON( data );
                  console.log("exito en la eliminacion");
                  
                  console.log(data);
                 
                  cargarVista();

                   //bootbox.alert("Equipo/sector ANULADO", function() {});
                },
            
          error: function(result){
                
                console.log(result);
              }
              //dataType: 'json'
    });

}

</script>
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
        <h4><p>¿ DESEA ELIMINAR ASOCIACIÓN ?</p></h4>
        </center>
      </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="eliminar()">SI</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        </center>
      </div>
    </div>
  </div>
</div>
