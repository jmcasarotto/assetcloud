<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Puntos de Pedido</h3>
          
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="stock" class="table table-bordered table-hover">
            <thead>
              <tr>
               
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Deposito</th>
                <th>Punto Pedido</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list) > 0) {                  
                	foreach($list as $f)
      		        {
  	                echo '<tr>';
  	                
                    /*
                    if (strpos($permission,'Edit') !== false) {
  	                	echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" onclick="LoadStk('.$s['stkId'].',\'Edit\')"></i>';
                    }
                    if (strpos($permission,'Del') !== false) {
  	                	echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" onclick="LoadStk('.$s['stkId'].',\'Del\')"></i>';
                    }
                    */
                  
  	              
                  echo '<td style="text-align: left">'.$f['artBarCode'].'</td>';
                  echo '<td style="text-align: left">'.$f['artDescription'].'</td>';
                  echo '<td style="text-align: left">'.$f['cantidad'].'</td>';
                  echo '<td style="text-align: left">'.$f['depositodescrip'].'</td>';
                  echo '<td style="text-align: left">'.$f['punto_pedido'].'</td>';
                  
                  echo '<td style="text-align: center">'.($f['lotestado'] == 'AC' ? '<small class="label pull-left bg-green">Activo</small>' : ($f['lotestado'] == 'IN' ? '<small class="label pull-left bg-red">Inactivo</small>' : '<small class="label pull-left bg-yellow">Suspendido</small>')).'</td>';
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

<script>
  $(function () {
    //$("#groups").DataTable();
    $('#stock').DataTable({
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

  var idStk = 0;
  var acStk = '';
  
  function LoadStk(id_, action){
  	idStk = id_;
  	acStk = action;
  	LoadIconAction('modalAction',action);
  	WaitingOpen('Cargando Movimiento');
      $.ajax({
          	type: 'POST',
          	data: { id : id_, act: action },
    		    url: 'index.php/stock/getMotion', 
    		    success: function(result){
			                WaitingClose();
			                $("#modalBodyStock").html(result.html);
			                setTimeout("$('#modalStock').modal('show')",800);
                      $(".select2").select2({
                        allowClear: true
                      });
    					},
    		    error: function(result){
    					WaitingClose();
    					alert("error");
    				},
          	dataType: 'json'
    		});
  }

  
  $('#btnSave').click(function(){

  	if(acStk == 'View')
  	{
  		$('#modalStock').modal('hide');
  		return;
  	}

  	var hayError = false;
    if($('#stkCant').val() == '')
    {
    	hayError = true;
    }

    if($('#stkMotive').val() == '')
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
                    id : idStk, 
                    act: acStk, 
                    prodId: $('#prodId').val(),
                    cant: $('#stkCant').val(),
                    motive: $('#stkMotive').val()
                  },
    		url: 'index.php/stock/setMotion', 
    		success: function(result){
                			WaitingClose();
                			$('#modalStock').modal('hide');
                			setTimeout("cargarView('Stock', 'index', '"+$('#permission').val()+"');",1000);
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
<div class="modal fade" id="modalStock" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Movimiento</h4> 
      </div>
      <div class="modal-body" id="modalBodyStock">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
      </div>
    </div>
  </div>
</div>