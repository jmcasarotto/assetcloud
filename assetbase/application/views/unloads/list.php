<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Vales de Entrada</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="cargOrden">Cargar Vale</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="articles" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Fecha</th>             
                <th>Código</th>
                <th>Marca</th>
                <th>Descripción</th>
                <th>Responsable</th>
                <th>Destino</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list) > 0) {                  
                	foreach($list as $a)
      		        {
  	                echo '<tr>';
                    echo '<td style="text-align: left">'.$a['valedfecha'].'</td>';  	    
                    echo '<td style="text-align: left">'.$a['herrcodigo'].'</td>';            
                    echo '<td style="text-align: left">'.$a['herrmarca'].'</td>';
                    echo '<td style="text-align: left">'.$a['herrdescrip'].'</td>';
                    echo '<td style="text-align: left">'.$a['respons'].'</td>';
                    echo '<td style="text-align: left">'.$a['dest'].'</td>';                             
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

<!-- Resetea Nº de orden al recargar la pagina -->
<script>
 $('#cargOrden').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Unload/cargarValDesc/<?php echo $permission; ?>");
    WaitingClose();
  });
</script>
<!-- / Resetea Nº de orden al recargar la pagina -->

<script>

  $(function () {

    $('#articles').DataTable({
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
 
</script>


