<input type="hidden" id="permission" value="<?php echo $permission;?>">

<div class="panel panel-default">
  
  <div class="panel-heading">
    <h3 class="panel-title">Consulta</h3>
  </div>
  
  <div class="panel-body ">    

    <table id="servicio" class="table table-bordered table-hover">
        <thead>
            <tr>                                
                <th>Nro</th>
                <th>fecha</th>
                <th>Solicitante</th>
                <th>Equipo</th>
                <th>Ubicacion</th>
                <th>Causa</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(count($ordenes) > 0) {
                $i = 0;
                foreach ($ordenes as $ord) {
                 
                    echo '<tr>';                   
                    echo '<td style="text-align: left">'.$ord['id_solicitud'].'</td>';
                    echo '<td style="text-align: left">'.$ord['f_solicitado'].'</td>';
                    echo '<td style="text-align: left">'.$ord['solicitante'].'</td>';
                    echo '<td style="text-align: left">'.$ord['codigo'].'</td>';
                    echo '<td style="text-align: left">'.$ord['ubicacion'].'</td>';
                    echo '<td style="text-align: left">'.$ord['causa'].'</td>';
                    echo '<td style="text-align: center">'.($ord['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' :($ord['estado'] == 'T' ? '<small class="label pull-left bg-blue">Terminado</small>' : '<small class="label pull-left bg-red">Solicitado</small>')).'</td>';
                    echo '</tr>';
                    
                } //   / foreach
            }
            ?>
        </tbody>
    </table>

  </div> <!-- / panel-body -->
</div>