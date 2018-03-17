<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Carga de Lectura</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
               
              ?>
            
              <button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" id="btnAgre" title="Agregar">Agregar </button>

            <? }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="sales" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Equipo</th>
                <th>Frecuencia</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Valor</th>
                <th>Criticidad </th>
                

              </tr>
            </thead>
            <tbody>
              <?php

               foreach($list as $a)
                  {
                
                    $id=$a['id_lectura'];
                    echo '<tr id="'.$id.'">';
                    echo '<td>';
                    if (strpos($permission,'Edit') !== false) {
                      echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;></i>';
                    }
                    if (strpos($permission,'Del') !== false) {
                      echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;></i>';
                    }
                    
                   
                    echo '</td>';
                    echo '<td style="text-align: right">'.$a['codigo'].'</td>';
                    echo '<td style="text-align: left">'.$a['frecuencia'].'</td>';
                    echo '<td style="text-align: right">'.$a['fecha'].'</td>';
                    echo '<td style="text-align: right">'.$a['hora'].'</td>';
                    //echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                    
                    echo '<td style="text-align: right">'.$a['lectura'].'</td>';

                    echo '<td style="text-align: center">'.($a['descripcion'] == 'MEDIA' ? '<small class="label pull-left bg-green">Media</small>' : ($a['descripcion'] == 'ALTA' ? '<small class="label pull-left bg-red">Alta</small>' : ($a['descripcion'] == 'ESPECIAL' ? '<small class="label pull-left bg-blue">Especial</small>':'<small class="label pull-left bg-yellow">Baja</small>'))).'</td>';
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
  var isOpenWindow = false;


$(document).ready(function(event) {

    edit=0;  datos=Array();

    $('#btnAgre').click(function(){  
      //alert('click add');
      $('#fecha').val('');
      $('#hora').val('');
      $('#equipo').val('');
      $('#frecuencia').val('');
      $('#criticidad').val('');   
      $('#lectura').val('');


      $('#tablacomp tbody tr').remove();

      $('#modalSale').modal('show');
       
       OpenSale();
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
        setTimeout(function () { $('#artId').focus(); }, 1000);
        $('#saleDetail > tbody').html('');
       
        WaitingClose();
       
      }
    }
  }




  function cerro(){
    
    isOpenWindow = false;
  }

  
  
 traer_equipo();
  function traer_equipo(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Lectura/getequipo', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#equipo').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
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

   

  traer_criticidad();
  function traer_criticidad(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Lectura/getcriticidad', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#criticidad').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_criti']+"'>" +nombre+ "</option>" ; 

                    $('#criticidad').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
  }
  
  

function guardar()
  {     alert("si guardo ");

        //var id = $('#id').val();
        
        var fecha = $('#fecha').val();
        var hora = $('#hora').val();
        var equipo = $('#equipo').val();
        var frecuencia = $('#frecuencia').val();
        var criticidad = $('#criticidad').val();
        var lectura = $('#lectura').val();
        


       
       

        var parametros = {
            'fecha': fecha,
            'hora': hora,
            'id_equipo': equipo,
            'frecuencia': frecuencia,
            'id_criticidad': criticidad,
            'lectura': lectura,
                        
        };
         
          $.ajax({
              type: 'POST',
              data: {data:parametros },
              url: 'index.php/Lectura/guardar_lectura',  //index.php/
              success: function(data){
                     // var data = jQuery.parseJSON( result );
                      
                      $('#modalSale').modal('hide');

                       setTimeout(function(){
                             var permisos = '<?php echo $permission; ?>';
                            cargarView('lectura', 'index', permisos) ; 
                      },3000); // 3000ms = 3s
                     
                    },
              error: function(result){
                    
                    console.log(result);
                    $('#modalSale').modal('hide');
                  },
                  dataType: 'json'
              });
       
            
  }
  $('#equipo').onchange = function(){

   var idequipo = $(this).parent('td').parent('tr').attr('id');
   $.ajax({
              type: 'POST',
              data: {idequipo:idequipo },
              url: 'index.php/Lectura/getparametros',  //index.php/
              success: function(data){
                                        
                      $('#modalSale').modal('hide');

                       setTimeout(function(){
                             var permisos = '<?php echo $permission; ?>';
                            cargarView('lectura', 'index', permisos) ; 
                      },3000); // 3000ms = 3s
                     
                    },
              error: function(result){
                    
                    console.log(result);
                    $('#modalSale').modal('hide');
                  },
                  dataType: 'json'
              });

  };

  

</script>



<!-- Modal -->
<div class="modal fade" id="modalSale" tabindex="2000" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale"> </span></h4> 
      </div>

      <div class="modal-body" id="modalBodySale">
        
        <div class="row" >
        <div class="col-sm-12 col-md-12">
         <br>

            <fieldset><legend></legend></fieldset>
                <div class="form-group">
                  <label class="control-label col-xs-4">Carga de Lectura</label> 
                  <div class="col-xs-4">
                  
                  </div>
                </div>
                
                <br>
                <fieldset><legend></legend></fieldset>


                <div class="col-xs-8">Equipos:
                   <select id="equipo" name="equipo" class="form-control"  />
                   <input type="hidden" id="id_equipo" name="id_equipo">
                </div>
                <div class="col-xs-3"><label></label> 
                    <button type="button" class="btn btn-success" id="add"><i class="fa fa-check"></i>Agregar</button>
                </div>
                <div class="col-xs-8">valor:
                   <select id="valor" name="valor" class="form-control"  />
                   <input type="hidden" id="id_equipo" name="id_equipo">
                </div>
                

              </div>
            </div>

            <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                      <table class="table table-bordered" id="tablaparametro"> 
                        <thead>
                        <tr>                           <!--no encuentro la x <i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" -->
                        <br>
                        <th width="35px"></th>
                        <th width="10%"></th>
                        <th>/th>
                        <th width="10%"></th>
                       
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>  
                
                  </div>
                </div>
</div>
</div>
</div>
                
         

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
          <button type="button" class="btn btn-primary"  onclick="guardar()">Guardar</button>
        </div>

      </div>
  </div>
</div>
