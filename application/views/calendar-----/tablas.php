
<?php     
 //dump($permission, 'permisos');
  if (strpos($permission,'Correctivo') !== false){
?>
      <!-- CORRECTIVO -->
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Solicitud de Servicios</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->

          <div class="box-body">
              <table id="correctivo" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th style="text-align: center" class="hidden">Id Equipo</th>
                    <th style="text-align: center" class="hidden">Id predictivo</th>
                    <th style="text-align: center">OT</th>
                    <th style="text-align: center">Codigo</th>
                    <th style="text-align: center">Causa</th>
                    <!-- <th style="text-align: center">sector</th> -->
                    <!--<th style="text-align: center">Tipo</th>-->
                    <th style="text-align: center">F.Solicitado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  //dump_exit($list4);
                  if( count($list4) > 0) {

                    foreach( $list4 as $c ) {

                      $id_sol = $c['id_solicitud'];
                      $id_eq = $c['id_equipo'];

                      echo '<tr id="'.$id_sol.'" data-idequipo="'.$id_eq.'" >';
                      //echo "<tr >";
                      echo "<td>";
                      //  if (strpos($permission,'Del') !== false) {
                            //alternativa a orden hecha fa fa-stop-circle-o
                            echo '<i class="fa fa-stop-circle" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" data-toggle="modal" data-target="#modal-correctivo" onclick="fill_Correc('.$c['id_solicitud'].')"></i>';
                      //  }
                      echo "</td>";

                      // 1 // id equipo
                      echo "<td style='text-align: center' class='hidden'>".$c['id_equipo']."</td>";
                      // 2 // id solicitud reparacion
                      echo "<td style='text-align: center' class='hidden'>".$c['id_solicitud']."</td>";
                      // 3 // codigo de equipo
                      echo "<td style='text-align: center'>".$c['codigo']."</td>";
                      // 4 // descripcion causa solicitud
                      echo "<td style='text-align: center'>".$c['causa']."</td>";
                      // 5 // fecha guardada anteriromente
                      echo "<td style='text-align: center'>".$c['f_solicitado']."</td>";

                      echo "</tr>";
                    }
                  }
                  ?>
                </tbody>
              </table>
          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div><!-- /.col-md-6 -->
<?php
}
?>

<?php     
  if (strpos($permission,'Preventivo') !== false){
?>
      <!-- PREVENTIVO -->
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Preventivo</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->

          <div class="box-body">
            <table id="preventivo" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="text-align: center" class="hidden">Id Preventivo</th>
                        <th style="text-align: center" class="hidden">Id Equipo</th>
                        <th style="text-align: center" class="hidden">Id tarea</th>

                        <th style="text-align: center">OT</th>
                        <th style="text-align: center">Equipo</th>
                        <th style="text-align: center">Tarea</th>
                        <th style="text-align: center">Fecha</th>
                        <!-- <th style="text-align: center">Horas H.</th> -->
                        <th style="text-align: center">Periodo</th>
                        <th style="text-align: center">Frec.</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if( count($list3) > 0) {

                        //dump_exit($list3);
                        foreach( $list3 as $p ) {                         

                          //echo "<tr>";
                          echo '<tr id="'.$p['prevId'].'" >';
                            // 0
                            echo "<td>";
                              //if (strpos($permission,'Del') !== false) {
                                  echo '<i class="fa fa-square" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" data-toggle="modal" data-target="#modal-preventivo" onclick="fill_Prevent('.$p['prevId'].')"></i>';
                              //}
                                  
                            echo "</td>";                           

                            // 1  //id de preventivo
                            echo "<td style='text-align: center' data-prevId".$p['prevId']." class='hidden'>".$p['prevId']."</td>";
                            // 2  //id de equipo
                            echo "<td style='text-align: center' class='hidden'>".$p['id_equipo']."</td>";
                            // 3  //id de tarea
                            echo "<td style='text-align: center' class='hidden'>".$p['id_tarea']."</td>";
                            // 4  //codigo equipo
                            echo "<td style='text-align: center'>".$p['codigo']."</td>";
                            // 5  //descrip prevent
                            echo "<td style='text-align: center'>".$p['descripcion']."</td>";
                            // 6  //ult prevent
                            echo "<td style='text-align: center'>".$p['ultimo']."</td>";
                            // 7  //horas hombre
                            //echo "<td style='text-align: center'>".$p['horash']."</td>";
                            // 8  //periodo
                            echo "<td style='text-align: center'>".$p['perido']."</td>";
                            // 9  //frecuencia
                            echo "<td style='text-align: center'>".$p['cantidad']."</td>";

                          echo "</tr>";
                        }
                      }
                      ?>
                    </tbody>
                  </table>

          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div><!-- /.col -->

      <!-- PREVENTIVO P/HORAS-->
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Preventivo por Horas</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->

          <div class="box-body">
            <table id="preventivo_horas" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="text-align: center" class="hidden">Id Preventivo</th>
                        <th style="text-align: center" class="hidden">Id Equipo</th>
                        <th style="text-align: center" class="hidden">Id tarea</th>

                        <th style="text-align: center">OT</th>
                        <th style="text-align: center">Equipo</th>
                        <th style="text-align: center">Tarea</th>
                        <th style="text-align: center">Fecha</th>
                        <!-- <th style="text-align: center">Horas H.</th> -->
                        <th style="text-align: center">Periodo</th>
                        <th style="text-align: center">Frec.</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if( count($list) > 0) {

                        //dump_exit($list);
                        foreach( $list as $p ) {
                          // curso, critico, vencido
                          $estado = 'bg-gray';
                          if( $p['estadoprev'] == 'C'  ) { $estado = 'bg-green'; }
                          if( $p['estadoprev'] == 'CR' ) { $estado = 'bg-orange'; }
                          if( $p['estadoprev'] == 'VE' ) { $estado = 'bg-red'; }

                          echo "<tr>";
                            // 0
                            echo "<td>";
                             // if (strpos($permission,'Del') !== false) {
                                  echo '<i class="fa fa-history" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" data-toggle="modal" data-target="#modal-preventivo"></i>';
                             // }
                            echo "</td>";

                            // 1  //id de preventivo
                            echo "<td style='text-align: center' class='hidden'>".$p['prevId']."</td>";
                            // 2  //id de equipo
                            echo "<td style='text-align: center' class='hidden'>".$p['id_equipo']."</td>";
                            // 3  //id de tarea
                            echo "<td style='text-align: center' class='hidden'>".$p['id_tarea']."</td>";
                            // 4  //codigo equipo
                            echo "<td style='text-align: center'>".$p['codigo']."</td>";
                            // 5  //descrip prevent
                            echo "<td style='text-align: center'>".$p['descripcion']."</td>";
                            // 6  //prox prevent
                            echo "<td style='text-align: center'>".$p['prox']."</td>";
                            // 7  //horas hombre
                            //echo "<td style='text-align: center'>".$p['horash']."</td>";
                            // 8  //periodo
                            echo "<td style='text-align: center'>".$p['perido']."</td>";
                            // 9  //frecuencia
                            echo "<td style='text-align: center'>".$p['cantidad']."</td>";

                          echo "</tr>";
                        }
                      }
                      ?>
                    </tbody>
                  </table>

          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div><!-- /.col --> 
<?php
}
?>

<?php     
  if (strpos($permission,'Backlog') !== false){
?>

      <!-- TAREAS BACKLOG -->
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Backlog</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->

          <div class="box-body">
            <table id="backlog" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align: center" class="hidden">Id Equipo</th>
                  <th style="text-align: center" class="hidden">Id Backlog</th>    
                  <th style="text-align: center">OT</th>
                  <th style="text-align: center">Codigo</th>
                  <th style="text-align: center">Causa</th>
                  <th style="text-align: center">Fecha</th>
                  <th style="text-align: center" class="hidden">Id tarea</th>
                </tr>

              </thead>
              <tbody>
                <?php
                
                //dump_exit($list2);
                if( count($list2) > 0) {

                  foreach( $list2 as $b ) {

                    // curso, critico, vencido
                    // $estado = 'bg-gray';
                    // if( $b['estado'] == 'C'  ) { $estado = 'bg-green'; }
                    // if( $b['estado'] == 'CR' ) { $estado = 'bg-orange'; }
                    // if( $b['estado'] == 'VE' ) { $estado = 'bg-red'; }

                    echo "<tr>";

                    echo "<td>";
                       // if (strpos($permission,'Del') !== false) {
                            //alternativa a orden hecha fa fa-stop-circle-o
                            echo '<i class="fa fa-check-square" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" data-toggle="modal" data-target="#modal-backlog" onclick="fill_Backlog('.$b['backId'].')"></i>';
                       // }
                    echo "</td>";

                    // 1 // id equipo
                    echo "<td style='text-align: center' class='hidden'>".$b['id_equipo']."</td>";
                    // 2 // id solicitud reparacion
                    echo "<td style='text-align: center' class='hidden'>".$b['backId']."</td>"; 
                    // 3 // codigo de equipo
                    echo "<td style='text-align: center'>".$b['codigo']."</td>";
                    // 4 // descripcion causa solicitud
                    echo "<td style='text-align: center'>".$b['tarea']."</td>";
                    // 5 // fecha guardada anteriromente
                    echo "<td style='text-align: center'>".$b['fecha']."</td>";
                    // 6 // id de tarea
                    echo "<td style='text-align: center' class='hidden'>".$b['tarea_descrip']."</td>";

                    echo "</tr>";
                  }
                }
                ?>
              </tbody>
            </table>

          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div>
<?php
}
?> 

<?php     
  if (strpos($permission,'Predictivo') !== false){
?>

      <!-- TAREAS PREDICTIVO -->
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Predictivo</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->

          <div class="box-body">
            <table id="predictivo" class="table table-bordered table-hover">
              <thead>
                <tr>

                  <th style="text-align: center" class="hidden">Id tarea</th>
                  <th style="text-align: center" class="hidden">Id Equipo</th>
                  <th style="text-align: center" class="hidden">Id predictivo</th>

                  <th style="text-align: center">OT</th>
                  <th style="text-align: center">Código</th>
                  <th style="text-align: center">Descrip</th>
                  <th style="text-align: center">Fecha</th>
                  <th style="text-align: center">Período</th>
                  <th style="text-align: center">Frec.</th>
                </tr>
              </thead>
              <tbody>
                <?php
                //dump_exit($list1);
                if( count($list1) > 0) {
                  
                  foreach( $list1 as $p ) {

                    echo "<tr>";
                    // 0
                    echo "<td>";
                      //  if (strpos($permission,'Del') !== false) {
                            echo '<i class="fa fa-circle-thin predictivo" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" data-toggle="modal" data-target="#modal-fecha" onclick="fill_Predictivo('.$p['predId'].')"></i>';
                      //  }
                    echo "</td>";
                    // 1  //id de tarea
                    echo "<td style='text-align: center' class='hidden'>".$p['tarea_descrip']."</td>";
                    // 2 // id equipo
                    echo "<td style='text-align: center' class='hidden'>".$p['id_equipo']."</td>";
                    // 3 // id predictivo
                    echo "<td style='text-align: center' class='hidden'>".$p['predId']."</td>";
                    // 4 // codigo de equipo
                    echo "<td style='text-align: center'>".$p['codigo']."</td>";
                    // 5 // descripcion tarea
                    echo "<td style='text-align: center'>".$p['descripcion']."</td>";
                    // 6 // fecha guardada anteriromente
                    echo "<td style='text-align: center'>".$p['fecha']."</td>";
                    // 7 // periodo de tiempo
                    echo "<td style='text-align: center'>".$p['periodo']."</td>";
                    // 8 // cantidad de tiempo
                    echo "<td style='text-align: center'>".$p['cantidad']."</td>";

                    echo "</tr>";
                  }
                }
                ?>
              </tbody>
            </table>

          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div>
<?php
}
?> 