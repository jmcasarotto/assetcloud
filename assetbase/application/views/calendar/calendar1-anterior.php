<section class="content">
    <style>
      input.prevent{border: none; padding-left: 5px; width: 100%;}
    </style>

    <div class="row">

      <!-- CALENDARIO -->
      <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">                
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
      </div><!-- /.col -->

      <!-- CORRECTIVO -->      
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Tareas Correctivo</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Correctivo">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->
          
          <div class="box-body">
              <table id="correctivo" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th style="text-align: center">OT</th>
                    <th style="text-align: center">Codigo</th>
                    <th style="text-align: center">Descripcion</th>
                    <th style="text-align: center">sector</th>
                    <!--<th style="text-align: center">Tipo</th>-->
                    <th style="text-align: center">F.Solicitado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                   if( count($list4) > 0) {

                    foreach( $list4 as $c ) {
                      // curso, critico, vencido
                      $estado = 'bg-gray';
                      if( $c['estadoprev'] == 'C'  ) { $estado = 'bg-green'; }
                      if( $c['estadoprev'] == 'CR' ) { $estado = 'bg-orange'; }
                      if( $c['estadoprev'] == 'VE' ) { $estado = 'bg-red'; }


                      $id_sol = $c['id_solicitud'];                                    
                      $id_eq = $c['id_equipo'];

                      echo '<tr id="'.$id_sol.'" data-idequipo="'.$id_eq.'" >';
                      //echo "<tr >";
                      echo "<td>";
                        if (strpos($permission,'Del') !== false) {                                          
                            echo '<i class="fa fa-file-text" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" ></i>';
                        }
                      echo "</td>";
                      echo "<td style='text-align: center'>".$c['codigo']."</td>";
                      echo '<td style="text-align: left">'.$c['causa'].'</td>';
                      echo '<td style="text-align: left">'.$c['sector'].'</td>';
                      echo '<td style="text-align: left">'.$c['f_solicitado'].'</td>';
                      
                      // echo '<td style="text-align: left">'.$c['solicitante'].'</td>';
                      // echo '<td style="text-align: left">'.$c['equipo'].'</td>';                      
                      // echo '<td style="text-align: left">'.$c['grupo'].'</td>';
                      // echo '<td style="text-align: left">'.$c['ubicacion'].'</td>';
                      // echo '<td style="text-align: left">'.$c['descripcion'].'</td>';                      
                      // echo "<td style='text-align: center'>".$c['codigo']."</td>";
                      // echo "<td style='text-align: center'>".$c['codigo']."</td>";
                      // echo "<td style='text-align: center'>".$c['causa']."</td>";
                      
                      echo "</tr>";
                    }
                  }
                  ?>
                </tbody>
              </table>
          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div><!-- /.col-md-6 --> 

      <!-- PREVENTIVO -->
      <div class="col-md-6">
        <div class="box collapsed-box">
          
          <div class="box-header">
            <h3 class="box-title">Tareas Preventivo</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Preventivo">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->
          
          <div class="box-body">
            <table id="preventivo" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="text-align: center">OT</th>
                        <th style="text-align: center">Equipo</th>
                        <th style="text-align: center">Tarea</th>
                        <th style="text-align: center">Fecha</th>
                        <th style="text-align: center">Horas h</th>
                        <th style="text-align: center">id tarea</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if( count($list3) > 0) {

                        //dump_exit($list3);
                        foreach( $list3 as $p ) {
                          // curso, critico, vencido
                          $estado = 'bg-gray';
                          if( $p['estadoprev'] == 'C'  ) { $estado = 'bg-green'; }
                          if( $p['estadoprev'] == 'CR' ) { $estado = 'bg-orange'; }
                          if( $p['estadoprev'] == 'VE' ) { $estado = 'bg-red'; }

                          echo "<tr>";

                            echo "<td>";
                              if (strpos($permission,'Del') !== false) {                                          
                                  echo '<i class="fa fa-bed" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" data-toggle="modal" data-target="#modalfecha"></i>';
                              }
                            echo "</td>";
                            echo "<td style='text-align: center'>".$p['codigo']."</td>";
                            echo "<td style='text-align: center'>".$p['descripcion']."</td>";
                            echo "<td style='text-align: center'>".$p['prox']."</td>";
                            echo "<td style='text-align: center'>".$p['horash']."</td>";

                            echo "<td style='text-align: center'>".$p['id_tarea']."</td>";


                          echo "</tr>";
                        }
                      }
                      ?>
                    </tbody>
                  </table>
              
          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div><!-- /.col --> 

      <!-- PREVENTIVO POR HORA -->
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Preventivo por Horas</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Prev. p/ Horas">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->
          
          <div class="box-body">
            <table id="preventhoras" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align: center">Codigo</th>
                  <th style="text-align: center">Descripcion</th>
                  <th style="text-align: center">sector</th>
                  <th style="text-align: center">Tipo</th>
                  
                                          </tr>
              </thead>
              <tbody>
                <?php
                if( count($list['data']) > 0) {
                  foreach( $list['data'] as $a ) {
                    // curso, critico, vencido
                    $estado = 'bg-gray';
                    if( $a['estadoprev'] == 'C'  ) { $estado = 'bg-green'; }
                    if( $a['estadoprev'] == 'CR' ) { $estado = 'bg-orange'; }
                    if( $a['estadoprev'] == 'VE' ) { $estado = 'bg-red'; }

                    echo "<tr>";
                    echo "<td style='text-align: center'>".$a['codigo']."</td>";
                    echo "<td style='text-align: center'>".$a['descripcion']."</td>";
                    echo "<td style='text-align: center'>".$a['descripSector']."</td>";
                    echo "<td style='text-align: center'>".$a['perido']."</td>";
                    
                    echo "</tr>";
                  }
                }
                ?>
              </tbody>
            </table>              
          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div>  

      <!-- TAREASBACKLOG -->
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Tareas Backlog</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Backlog">
                <i class="fa fa-plus"></i></button>
            </div>
          </div><!-- /.box-header -->
          
          <div class="box-body">
            <table id="backlog" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center">Id</th>
                          <th style="text-align: center">Descripcion</th>
                          <th style="text-align: center">Equipo</th>
                          <th style="text-align: center">Fecha</th>
                          
                                                  </tr>
                      </thead>
                      <tbody>
                        <?php
                        if( count($list2) > 0) {

                          foreach( $list2 as $b ) {

                            // curso, critico, vencido
                            $estado = 'bg-gray';
                            if( $b['estado'] == 'C'  ) { $estado = 'bg-green'; }
                            if( $b['estado'] == 'CR' ) { $estado = 'bg-orange'; }
                            if( $b['estado'] == 'VE' ) { $estado = 'bg-red'; }

                            echo "<tr>";
                            echo "<td style='text-align: center'>".$b['backId']."</td>";
                            echo "<td style='text-align: center'>".$b['tarea_descrip']."</td>";
                            echo "<td style='text-align: center'>".$b['codigo']."</td>";
                            echo "<td style='text-align: center'>".$b['fecha']."</td>";
                            
                            echo "</tr>";
                          }
                        }
                        ?>
                      </tbody>
                    </table>  
              
          </div><!-- /.box-body -->

        </div><!-- /.box collapsed-box-->
      </div>

      <!-- TAREAS PREDICTIVO -->
      <div class="col-md-6">
        <div class="box collapsed-box">

          <div class="box-header">
            <h3 class="box-title">Tareas Predictivo</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Predictivo">
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
                  <th style="text-align: center">Codigo</th>
                  <th style="text-align: center">Descripcion</th>
                  <th style="text-align: center">Fecha</th>
                  <!-- <th style="text-align: center">H. Hombre</th> -->
                  <th style="text-align: center">Período</th>
                  <th style="text-align: center">Cantidad</th>                                   
                </tr>
              </thead>
              <tbody>
                <?php
                //dump_exit($list1);
                if( count($list1) > 0) {
                  foreach( $list1 as $p ) {

                    // curso, critico, vencido
                    $estado = 'bg-gray';
                    if( $a['estado'] == 'C'  ) { $estado = 'bg-green'; }
                    if( $a['estado'] == 'CR' ) { $estado = 'bg-orange'; }
                    if( $a['estado'] == 'VE' ) { $estado = 'bg-red'; }

                    echo "<tr>";
                    echo "<td>";
                        if (strpos($permission,'Del') !== false) {                                          
                            echo '<i class="fa fa-file-text predictivo" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" ></i>';
                        }
                      echo "</td>";
                    echo "<td style='text-align: center' class='hidden'>".$p['tarea_descrip']."</td>";//id de tarea
                    echo "<td style='text-align: center' class='hidden'>".$p['id_equipo']."</td>";
                    echo "<td style='text-align: center' class='hidden'>".$p['predId']."</td>";
                    
                    echo "<td style='text-align: center'>".$p['codigo']."</td>";
                    echo "<td style='text-align: center'>".$p['descripcion']."</td>";// descripcion tarea
                    echo "<td style='text-align: center'>".$p['fecha']."</td>";// fecha guardada anteriromente
                    //echo "<td style='text-align: center'>".$p['horash']."</td>";// descripcion de sector
                    echo "<td style='text-align: center'>".$p['periodo']."</td>";
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
     
</section><!-- /.content -->

<script>
/// PARA PREVENTIVO
  var id_tar ="";
  // var ico = '';
  // var fecha = '';

  // var nro = '';

  $('.fa-bed').click(function(){
    
     id_tar = $(this).parents("tr").find("td").eq(5).html();  //id de solicitud de servicios
     //alert(id_tar);
    alert(id_tar);
    // nro: $(this).parents("tr").attr('id'),  //id de solicitud de servicios                    
    // fech: $(this).parents("tr").find("td").eq(4).html(), // fecha solicitado
    // deta: $(this).parents("tr").find("td").eq(2).html(), // causa o  descripcion                   
    // id_equipo: $(this).parents("tr").data("idequipo"),
    // act: 'Add',
    // cli: 1,     // Es 1 xq se crea el cliente por defecto al poner en funcionamiento
    // sucid:1
  });




$(function () {

  //  Datatables
  $('#correctivo').DataTable({
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

  $('#preventivo').DataTable({
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

  $('#preventhoras').DataTable({
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

  $('#backlog').DataTable({
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

  $('#predictivo').DataTable({
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


  /*$('#btnAdd').click(function() {
      //Cargar clientes
      //Elegir fecha y hora(de mañana para adelante )
      //Registrar visita
      LoadIconAction('modalAction','Program');
      WaitingOpen('Cargando Clientes');
      $.ajax({
          type: 'POST',
          data: null,
          url: 'index.php/dash/getCustommers',
          success: function(result){
              WaitingClose();
              $("#modalBodyProgrammer").html(result.html);
              $('#vstFecha').datepicker({minDate: '0'});
              setTimeout("$('#modalProgrammer').modal('show');",800);
              $(".select2").select2();
          },
          error: function(result){
              WaitingClose();
              alert("error");
          },
          dataType: 'json'
      });
  });*/

  
  //  CALENDARIO
 
  /* initialize the external events
   -----------------------------------------------------------------*/
  function ini_events(ele) {
    ele.each(function () {
      // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
      // it doesn't need to have a start or end
      var eventObject = {
        title: $.trim($(this).text()) // use the element's text as the event title
      };

      // store the Event Object in the DOM element so we can get to it later
      $(this).data('eventObject', eventObject);

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 1070,
        revert: true, // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });
  }
  ini_events($('#external-events div.external-event'));

  /* initialize the calendar
   -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)
  var date = new Date();
  var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

  $('#calendar').fullCalendar({
    header: {
      left  : 'prev,next today',
      center: 'title',
      right : 'month,agendaWeek,agendaDay'
    },
    buttonText: {
      today: 'Hoy',
      month: 'Mes',
      week : 'Semana',
      day  : 'Día'
    },
    // desde aca busca los preventivos
    events: function(start, end, timezone, callback) {
      WaitingOpen('Cargando trabajo');
      var date_ = new Date($("#calendar").fullCalendar('getDate'));
      var month_ = date_.getMonth();
      var evento = $.ajax({
        url: 'index.php/Calendario/getcalendarot',
        data: { month: month_ },
        dataType: 'json',
        type: 'POST',
        success: function(doc) {
          var events = [];

          $(doc).each(function() {

            var from = $(this).attr('fecha_entrega'); //ultimo preventivo hecho
            var to = new Date(from);
            var hoy = new Date();
            var mes_actual = hoy.getMonth();

            console.log('dia de hoy por sistema');
            console.log(hoy);
            
            events.push({
              // title: $(this).attr('descripcion') + ',' + $(this).attr('id_tarea'),
              start:to,
              title: $(this).attr('descripcion'),
              codigo:$(this).attr('nro'),
              //id: $(this).attr('id_equipo'),
              //id_ot: $(this).attr('id_tarea'),
              allDay: false,
              backgroundColor: 'green',
              
            });
          });
          callback(events);
            WaitingClose();
          },
          error: function(doc) {
            WaitingClose();
            alert('Sin datos para este mes')
            //alert("Error en ajax calendario:" + doc);
          }
        });
      },

      eventClick: function(event) {
        // console.log('eventossss');
        // console.log(evento);

        console.log('Titulo:');
        console.log(event.title);
        //setTimeout("$('#modalPrevent').modal('show')",0);
        $('#title').remove();
        $('#codigo_equipo').remove();
        $('#modal_prev tbody').append(

          '<tr>'+
               '<td class="tit"><input type="text" class="title prevent" id="title" value=" '+ event.title +' " placeholder=""></td>'+
               '<td class="cod" id="cod"><input type="text" class="codigo_equipo prevent" id="codigo_equipo" value=" '+ event.codigo +' " placeholder=""></td>'+

               '<td class="id_equipo hidden" id="id_equipo"><input type="text" class="equip prevent" id="equip" name="equip" value="'+ event.id +'" placeholder=""></td>'+

               '<td class="solicitante hidden" id="solicitante"><input type="text" class="solici" id="solici" name="solici"value="Preventivo" placeholder=""></td>'+

               '<td class="fallas hidden" id="fallas"><input type="text" class="falla" id="falla" name="falla" value="Preventivo" placeholder=""></td>'+

               '<td class="fech hidden" id="fech"><input type="text" class="fecha" id="fecha" name="fecha" value="01-02-17" placeholder=""></td>'+

               '<td class="hor hidden" id="hor"><input type="text" class="hora" id="hora" name="hora" value="00" placeholder=""></td>'+
               '<td class="minutos hidden" id="minutos"><input type="text" class="min" id="min" name="min" value="00" placeholder=""></td>'+
          '</tr>'
          );

        $('#modalPrevent').modal('show');

      },

      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped
        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }
      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });

// Genera Orden de Trabajo y la guarda automaticamente 
  $('.fa-file-text').click( function cargarVista(){
     //WaitingOpen('Guardando Orden de Trabajo...');
     // console.log($(this).parents("tr").data("idequipo"));
    var date_ = new Date($("#calendar").fullCalendar('getDate'));
    var month_ = date_.getMonth() + 1;
   
    var  id = $(this).parents("tr").attr('id'); //id de solicitud de servicios
    var id_equipo = $(this).parents("tr").data("idequipo");

    $.ajax({
          type: 'POST',
          data: { id : $(this).parents("tr").attr('id'),  //id de solicitud de servicios
                  nro: $(this).parents("tr").attr('id'),  //id de solicitud de servicios                    
                  fech: $(this).parents("tr").find("td").eq(4).html(), // fecha solicitado
                  deta: $(this).parents("tr").find("td").eq(2).html(), // causa o  descripcion                   
                  id_equipo: $(this).parents("tr").data("idequipo"),
                  act: 'Add',
                  cli: 1,     // Es 1 xq se crea el cliente por defecto al poner en funcionamiento
                  sucid:1
                },
          url: 'index.php/Otrabajo/setotrabajo',
          success: function(result){
                      WaitingClose('Guardado exitosamente...');
                      //var permisos = '<?php //echo $permission; ?>';
                      var permisos = 'Add-Edit-Del-View-Asignar-Finalizar-OP-';
                      cargarView('Calendario', 'indexot', permisos) ;                        
                },
          error: function(result){
                WaitingClose();
                //alert("Error en guardado...");
                //cargarView('Calendario', 'indexot', permisos) ;  
              },
              dataType: 'json'
    });
  });

 $("#fecha").datepicker({
    Format: 'dd/mm/yy',
    startDate: '-3d'
    //firstDay: 1
  }).datepicker("setDate", new Date()); 

function setOtPreventivo() {
   
   //$(this).parents("tr").attr('id')
   // alert(ico);
   // $.ajax({
   //        type: 'POST',
   //        data: { id : $(this).parents("tr").attr('id'),  //id de solicitud de servicios
   //                nro: $(this).parents("tr").attr('id'),  //id de solicitud de servicios                    
   //                fech: $(this).parents("tr").find("td").eq(4).html(), // fecha solicitado
   //                deta: $(this).parents("tr").find("td").eq(2).html(), // causa o  descripcion                   
   //                id_equipo: $(this).parents("tr").data("idequipo"),
   //                act: 'Add',
   //                cli: 1,     // Es 1 xq se crea el cliente por defecto al poner en funcionamiento
   //                sucid:1
   //              },
   //        url: 'index.php/Otrabajo/setotrabajo',
   //        success: function(result){
   //                    WaitingClose('Guardado exitosamente...');
   //                    //var permisos = '<?php //echo $permission; ?>';
   //                    var permisos = 'Add-Edit-Del-View-Asignar-Finalizar-OP-';
   //                    cargarView('Calendario', 'indexot', permisos) ;                        
   //              },
   //        error: function(result){
   //              WaitingClose();
   //              //alert("Error en guardado...");
   //              //cargarView('Calendario', 'indexot', permisos) ;  
   //            },
   //            dataType: 'json'
   //  });
}


//////////  PREDICTIVO

  var idp = "";   // id predictivo
  var ide = "";   // id equipo
  var equipo = "";
  var tarea = "";
  var fecha = "";
  var desctarea = "";
  $(".predictivo").click(function(){
      
      
      tarea = $(this).parents("tr").find("td").eq(1).html(); 
      equipo = $(this).parents("tr").find("td").eq(2).html();
      idp = $(this).parents("tr").find("td").eq(3).html();
      fecha = $(this).parents("tr").find("td").eq(6).html();
      desctarea = $(this).parents("tr").find("td").eq(5).html();
       
      alert(idp);      
      alert(equipo);
       alert(tarea);
       alert(fecha);
      
  });

  // $(".predictivo").click(function(){
    
  //   var idp=$(this).parent('td').parent('tr').attr('id'); 
  //   var ide = $(this).parent('td').parent('tr').attr('class');
  //   console.log("El id de predictivo es:");
  //   console.log(idp);
  //   console.log("El id de equipo es:");
  //   console.log(ide);
  //   datos= parseInt(ide);
  //   console.log(datos); 

  //   $.ajax({
  //     type: 'POST',
  //     data: { idp: idp, datos:datos},
  //     url: 'index.php/Predictivo/getpredictivo', //index.php/
  //     success: function(data){
                          
  //             console.log(data);
             
  //             var equipo=data[0]['id_equipo'];
  //             var tarea=data[0]['tarea_descrip'];
  //             var fecha=data[0]['fecha'];

  //             $.ajax({
  //                 type: 'POST',
  //                 data: { idp:idp, equipo: equipo, tarea:tarea, fecha:fecha},
  //                 url: 'index.php/Predictivo/predictivoinertot', //index.php/
  //                 success: function(data){
  //                         console.log("Inserte una orden");          
  //                         console.log(data);
                         

  //                         $('#content').empty();
  //                         $("#content").load("<?php echo base_url(); ?>index.php/Predictivo/volver/<?php echo $permission; ?>");
                                               
                         
  //                       },
                    
  //                 error: function(result){
                                
  //                         console.log(result);
  //                       }
  //                 //dataType: 'json'
  //               });

                     
             
  //           },
        
  //     error: function(result){
                    
  //             console.log(result);
  //           },
  //     dataType: 'json'
  //   });

  // });


</script>
<!-- Guardado de datos y validaciones -->




<!-- Modal -->
  <div class="modal fade bs-example-modal-lg" id="modalPrevent" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><span id="modalAction_2">Mantenimiento Preventivo</span></h4>
        </div>
        <div class="modal-body" id="modalPrev">
          <table class="table table-condensed table-responsive modal_prev" id="modal_prev">
              <thead>
                <tr>
                  <th>Tarea</th>
                  <th>Equipo</th>
                  
                </tr>
              </thead>
              <tbody>

              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSave">Generar Solicitud</button>
        </div>
      </div>
    </div>
  </div>



<!-- Modal -->
<div class="modal fade" id="modal-fecha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Creación de Orden de Trabajo</h4>
      </div>
      <div class="modal-body">
        <h5>Seleccione la fecha de Programación</h5>
        <div class="col-xs-4">Fecha:
          <input type="text" id="fecha"  name="fecha" class="form-control input-md" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Generar Orden</button>
      </div>
    </div>
  </div>
</div>