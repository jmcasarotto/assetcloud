<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Menú</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" onclick="LoadCust(0,\'Add\')" id="btnAdd">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
			<table id="tMenu" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Acciones</th>
                        <th>ID menú</th>
                        <th>Parent</th>
						<th>Nombre</th>
						<th>Clase de ícono</th>
						<th>Slug</th>
						<th>Orden</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($data as $c)
				{

					echo '<tr id="'.$c['id'].'">';
					echo '<td>';
                    if (strpos($permission,'Add') !== false) {
                        echo '<i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" onclick="LoadUsr('.$c['id'].',\'Edit\')"></i>';
                    }
                    if (strpos($permission,'Del') !== false) {
                        echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" onclick="LoadUsr('.$c['id'].',\'Del\')"></i>';
                    }
                    if (strpos($permission,'View') !== false) {
                        echo '<i class="fa fa-fw fa-search text-light-blue" style="cursor: pointer; margin-left: 15px;" onclick="LoadUsr('.$c['id'].',\'View\')"></i>';
                    }
					echo '</td>';
                    echo '<td>'.$c['id'].'</td>';
					echo '<td>'.$c['parent'].'</td>';
					echo '<td>'.$c['name'].'</td>';
					echo '<td>'.$c['icon'].'</td>';
					echo '<td>'.$c['slug'].'</td>';
					echo '<td>'.$c['number'].'</td>';
					echo '</tr>';

				}
				?>
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</section>
<!-- /.content -->

<script>
$(function(){
    /* cargo plugin DataTable (debe ir al final de los script) */
    $("#tMenu").DataTable({
        "aLengthMenu": [ 10, 25, 50, 100 ],
        "autoWidth": true,
        "info": true,
        "ordering": true,
        "order": [[1, "asc"]],
        "paging": true,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Sig.",
                "sPrevious": "Ant."
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
            },
            "lengthChange": true,
            "searching": true,
            "sPaginationType": "full_numbers",
            "columnDefs": [ {
                "targets": [ 0 ], //no busco en acciones
                "searchable": false
            },
            {
                "targets": [ 0 ], //no ordena columna 0
                "orderable": false
            } ]
    });
});
</script>


<!-- Modal -->
<div class="modal fade" id="modalCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Menú</h4>
      </div>
      <div class="modal-body" id="modalBodyCustomer">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
      </div>
    </div>
  </div>
</div>