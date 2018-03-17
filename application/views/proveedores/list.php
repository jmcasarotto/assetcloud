<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Proveedores</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" onclick="Loadprovee(0,\'Add\')" id="btnAdd" title="Nueva">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="proveedor" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Nombre/ Razon Social</th>
                <th>Cuit/Cuil/dni</th>
                <th>Direccion</th>
                <th>telefono</th>
                <th>Email</th>
                <th>estado</th>
               
              </tr>
            </thead>
            <tbody>
              <?php
              	foreach($list as $f)
    		        {
                  //var_dump($u);

                  echo '<tr>';
                  echo '<td>';
                  

                  if (strpos($permission,'Edit') !== false) {
	              
                   echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" onclick="Loadprovee('.$f['provid'].',\'Edit\')"></i>';
                  
                  }
                  if (strpos($permission,'Del') !== false) {
	                 echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="Loadprovee('.$f['provid'].',\'Del\')"></i>';
                  }
                  if (strpos($permission,'View') !== false) {
	                	echo '<i class="fa fa-fw fa-search" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Consultar" onclick="Loadprovee('.$f['provid'].',\'View\')"></i>';
                  }
	                echo '</td>';
	                echo '<td style="text-align: left">'.$f['provnombre'].'</td>';
                  echo '<td style="text-align: left">'.$f['provcuit'].'</td>';
                  echo '<td style="text-align: left">'.$f['provdomicilio'].'</td>';
                  echo '<td style="text-align: left">'.$f['provtelefono'].'</td>';
                  echo '<td style="text-align: left">'.$f['provmail'].'</td>';
                  
                  echo '<td style="text-align: center">'.($f['provestado'] == '8' ? '<small class="label pull-left bg-green">Activo</small>' : ($f['provestado'] == '9' ? '<small class="label pull-left bg-red">Inactivo</small>' : '<small class="label pull-left bg-yellow">Suspendido</small>')).'</td>';
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
  $(function () {
    //$("#groups").DataTable();
    $('#proveedor').DataTable({
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

  
  var idFamily = 0;
  var acFamily = '';
  
  function Loadprovee(id_, action){
  	idrep = id_;
  	acrep = action;
  	LoadIconAction('modalAction',action);
  	WaitingOpen('Cargando Proveedor');
      $.ajax({
          	type: 'POST',
          	data: { id : id_, act: action },
    		url: 'index.php/proveedor/getproveedor', 
    		success: function(result){
			                WaitingClose();
			                $("#modalBodyProveedor").html(result.html);
			                setTimeout("$('#modalProveedor').modal('show')",800);
    					},
    		error: function(result){
    					WaitingClose();
    					alert("error");
    				},
          	dataType: 'json'
    		});
  }

  
  $('#btnSave').click(function(){
  	
  	if(acrep== 'View')
  	{
  		$('#modalProveedores').modal('hide');
  		return;
  	}

  	var hayError = false;
    if($('#nombre').val() == '')
    {
    	hayError = true;
    }
    if($('#direccion').val() == '')
    {
      hayError = true;
    }
    if($('#mail').val() == '')
    {
      hayError = true;
    }
    if($('#telefono').val() == '')
    {
      hayError = true;
    }

    if(hayError == true){
    	$('#error').fadeIn('slow');
    	return;
    }

    $('#error').fadeOut('slow');
    WaitingOpen('Guardando cambios');
    	$.ajax({
          	type: 'POST',
          	data: { 
                    id : idrep, 
                    act: acrep, 
                    name: $('#nombre').val(),
                    cuit: $('#cuit').val(),
                    dir: $('#direccion').val(),
                    mai: $('#mail').val(),
                    tel: $('#telefono').val(),
                    
                    est: $('#estado').val(),
                  },
    		url: 'index.php/Proveedor/setproveedor', 
    		success: function(result){
                			WaitingClose();
                			$('#modalProveedor').modal('hide');
                			setTimeout("cargarView('Proveedor', 'index', '"+$('#permission').val()+"');",1000);
    					},
    		error: function(result){
    					WaitingClose();
    					alert("error");
    				},
          	dataType: 'json'
    		});
  });

</script>


<!-- Modal -->
<div class="modal fade" id="modalProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> SOCIO</h4> 
      </div>
      <div class="modal-body" id="modalBodyProveedor">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
      </div>
    </div>
  </div>
</div>