<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Familias de Produtos</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" onclick="LoadFamily(0,\'Add\')" id="btnAdd" title="Nueva">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="familys" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Descripción</th>
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
	                 echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" onclick="LoadFamily('.$f['famId'].',\'Edit\')"></i>';
                  }
                  if (strpos($permission,'Del') !== false) {
	                 echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="LoadFamily('.$f['famId'].',\'Del\')"></i>';
                  }
                  if (strpos($permission,'View') !== false) {
	                	echo '<i class="fa fa-fw fa-search" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Consultar" onclick="LoadFamily('.$f['famId'].',\'View\')"></i>';
                  }
	                echo '</td>';
	                echo '<td style="text-align: left">'.$f['famName'].'</td>';
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
    $('#familys').DataTable({
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
  
  function LoadFamily(id_, action){
  	idFamily = id_;
  	acFamily = action;
  	LoadIconAction('modalAction',action);
  	WaitingOpen('Cargando Familia');
      $.ajax({
          	type: 'POST',
          	data: { id : id_, act: action },
    		url: 'index.php/family/getFamily', 
    		success: function(result){
			                WaitingClose();
			                $("#modalBodyFamily").html(result.html);
			                setTimeout("$('#modalFamily').modal('show')",800);
    					},
    		error: function(result){
    					WaitingClose();
    					alert("error");
    				},
          	dataType: 'json'
    		});
  }

  
  $('#btnSave').click(function(){
  	
  	if(acFamily == 'View')
  	{
  		$('#modalFamily').modal('hide');
  		return;
  	}

  	var hayError = false;
    if($('#famName').val() == '')
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
                    id : idFamily, 
                    act: acFamily, 
                    name: $('#famName').val()
                  },
    		url: 'index.php/family/setFamily', 
    		success: function(result){
                			WaitingClose();
                			$('#modalFamily').modal('hide');
                			setTimeout("cargarView('Family', 'index', '"+$('#permission').val()+"');",1000);
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
<div class="modal fade" id="modalFamily" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Familia</h4> 
      </div>
      <div class="modal-body" id="modalBodyFamily">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
      </div>
    </div>
  </div>
</div>