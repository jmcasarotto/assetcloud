<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Sub-Familias de Produtos</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" onclick="LoadSFFamily(0,\'Add\')" id="btnAdd">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="SFFamilys" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Descripción</th>
                <th>Familia</th>
              </tr>
            </thead>
            <tbody>
              <?php
              	foreach($list as $s)
    		        {
	                echo '<tr>';
	                echo '<td>';
                  if (strpos($permission,'Edit') !== false) {
	                	echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" onclick="LoadSFFamily('.$s['sfamId'].',\'Edit\')"></i>';
                  }
                  if (strpos($permission,'Del') !== false) {
	                	echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" onclick="LoadSFFamily('.$s['sfamId'].',\'Del\')"></i>';
                  }
                  if (strpos($permission,'View') !== false) {
	                	echo '<i class="fa fa-fw fa-search" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" onclick="LoadSFFamily('.$s['sfamId'].',\'View\')"></i> ';
                  }
	                echo '</td>';
	                echo '<td style="text-align: left">'.$s['sfamName'].'</td>';
                  echo '<td style="text-align: left">'.$s['famName'].'</td>';
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
    $('#SFFamilys').DataTable({
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

  
  var idSFFamily = 0;
  var acSFFamily = '';
  
  function LoadSFFamily(id_, action){
  	idSFFamily = id_;
  	acSFFamily = action;
  	LoadIconAction('modalAction',action);
  	WaitingOpen('Cargando Sub-Familia');
      $.ajax({
          	type: 'POST',
          	data: { id : id_, act: action },
    		url: 'index.php/Family/getSFFamily', 
    		success: function(result){
			                WaitingClose();
			                $("#modalBodySFFamily").html(result.html);
			                setTimeout("$('#modalSFFamily').modal('show')",800);
    					},
    		error: function(result){
    					WaitingClose();
    					alert("error");
    				},
          	dataType: 'json'
    		});
  }

  
  $('#btnSave').click(function(){
  	
  	if(acSFFamily == 'View')
  	{
  		$('#modalSFFamily').modal('hide');
  		return;
  	}

  	var hayError = false;
    if($('#sfamName').val() == '')
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
                    id : idSFFamily, 
                    act: acSFFamily, 
                    name: $('#sfamName').val(),
                    famId: $('#famId').val()
                  },
    		url: 'index.php/Family/setSFFamily', 
    		success: function(result){
                			WaitingClose();
                			$('#modalSFFamily').modal('hide');
                			setTimeout("cargarView('Family', 'indexSF', '"+$('#permission').val()+"');",1000);
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
<div class="modal fade" id="modalSFFamily" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Sub-Familia</h4> 
      </div>
      <div class="modal-body" id="modalBodySFFamily">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
      </div>
    </div>
  </div>
</div>