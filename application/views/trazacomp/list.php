<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Trazabilidad de Componentes</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 120px; margin-top: 10px;" id="recEntregar">Recib/Ent</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="trazacomponentes" class="table table-bordered table-hover">
            <thead>
              <tr> 
                <th>Equipo</th>             
                <th>Componente</th>
                <th>Recibido por</th>
                <th>Estado</th>                
              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list) > 0) {                  
                	foreach($list as $a)
      		        {
  	                echo '<tr>';
                    echo '<td style="text-align: left">'.$a['equipocodigo'].'</td>';  	    
                    echo '<td style="text-align: left">'.$a['componente'].'</td>';            
                    echo '<td style="text-align: left">'.$a['ult_recibe'].'</td>';  
                    echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' : ($a['estado'] == 'FP' ? '<small class="label pull-left bg-red">Fuera Pañol</small>' : '<small class="label pull-left bg-yellow">Pañol</small>')).'</td>';                        
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
 $('#recEntregar').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Trazacomp/recibEntrega/<?php echo $permission; ?>");
    WaitingClose();
  });
</script>
<!-- / Resetea Nº de orden al recargar la pagina -->

<script>

  $(function () {

    $('#trazacomponentes').DataTable({
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


